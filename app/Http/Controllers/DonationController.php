<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doacao;
use App\Models\Endereco;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationConfirmation;

class DonationController extends Controller
{
    // Etapa 1 - Dados pessoais
    public function step1()
    {
        return view('donation');
    }

    public function processStep1(Request $request)
    {
        try {
            // Validação simplificada
            $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telefone' => 'required|string|max:20',
                'nascimento' => 'required|string'
            ]);

            $step1Data = [
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'nascimento' => $request->nascimento,
                'aceita_comunicacoes' => $request->has('comunicacoes') ? true : false
            ];


            return view('donation-step2', compact('step1Data'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao processar dados. Tente novamente.');
        }
    }

    // Etapa 2 - Dados da doação
    public function step2(Request $request)
    {
        $step1Data = json_decode($request->input('step1_data'), true);
        
        if (!$step1Data) {
            return redirect()->route('donation');
        }

        return view('donation-step2', compact('step1Data'));
    }

    public function processStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'step1_data' => 'required|string',
            'tipo_doacao' => 'required|in:dinheiro,alimentos,material',
            'valor_customizado' => 'nullable|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $step1Data = json_decode($request->input('step1_data'), true);
        $step2Data = $request->only(['tipo_doacao', 'valor_customizado', 'descricao_itens']);

        // Combinar dados das etapas 1 e 2
        $combinedData = array_merge($step1Data, $step2Data);

        return view('donation-step3', compact('combinedData'));
    }

    // Etapa 3 - Endereço
    public function step3(Request $request)
    {
        $combinedData = json_decode($request->input('combined_data'), true);
        
        if (!$combinedData) {
            return redirect()->route('donation');
        }

        return view('donation-step3', compact('combinedData'));
    }

    public function processStep3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'combined_data' => 'required|string',
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|size:2',
            'horario_entrega' => 'required|in:manha_seg_sex,tarde_seg_sex,manha_sab',
            'instrucoes' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $combinedData = json_decode($request->input('combined_data'), true);
        
        $step3Data = $request->only([
            'cep', 'logradouro', 'numero', 'bairro', 
            'cidade', 'estado', 'horario_entrega', 'instrucoes'
        ]);
        $step3Data['tipo_entrega'] = 'entrega'; // Sempre entrega no Lar
        $step3Data['complemento'] = null; // Não usado mais

        // Combinar todos os dados
        $allData = array_merge($combinedData, $step3Data);

        return view('donation-confirmation', compact('allData'));
    }

    // Confirmação final
    public function confirmation(Request $request)
    {
        $allData = json_decode($request->input('all_data'), true);
        
        if (!$allData) {
            return redirect()->route('donation');
        }

        return view('donation-confirmation', compact('allData'));
    }

    public function finalize(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'all_data' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('donation');
        }

        $allData = json_decode($request->input('all_data'), true);
        

        try {
            // Criar doação
            // Converter data de nascimento para YYYY-MM-DD
            $dataNascimento = null;
            if (isset($allData['nascimento']) && $allData['nascimento']) {
                $nascimento = $allData['nascimento'];
                
                // Se a data não tem separadores (ex: 31102004), adicionar barras
                if (strlen($nascimento) === 8 && is_numeric($nascimento)) {
                    $nascimento = substr($nascimento, 0, 2) . '/' . substr($nascimento, 2, 2) . '/' . substr($nascimento, 4, 4);
                }
                
                try {
                    $dataNascimento = \Carbon\Carbon::createFromFormat('d/m/Y', $nascimento)->format('Y-m-d');
                } catch (\Exception $e) {
                    \Log::error('Erro ao converter data:', ['nascimento' => $nascimento, 'original' => $allData['nascimento']]);
                    throw new \Exception('Data de nascimento inválida: ' . $allData['nascimento']);
                }
            }
            
            $doacaoData = [
                'nome' => $allData['nome'],
                'email' => auth()->user()->email, // Usar email do usuário logado
                'telefone' => $allData['telefone'],
                'data_nascimento' => $dataNascimento,
                'sexo' => 'outro', // Valor padrão já que não coletamos no formulário
                'aceita_comunicacoes' => $allData['aceita_comunicacoes'] ? 1 : 0,
                'tipo_doacao' => $allData['tipo_doacao'],
                'valor' => $allData['valor_customizado'] ?? null,
                'frequencia' => 'unica', // Sempre única agora
                'descricao_itens' => $allData['descricao_itens'] ?? null,
                'cep' => $allData['cep'],
                'logradouro' => $allData['logradouro'],
                'numero' => $allData['numero'],
                'complemento' => $allData['complemento'] ?? null,
                'bairro' => $allData['bairro'],
                'cidade' => $allData['cidade'],
                'estado' => $allData['estado'],
                'status' => 'em_espera'
            ];
            
            $doacao = Doacao::create($doacaoData);

            // Criar endereço
            Endereco::create([
                'doacao_id' => $doacao->id,
                'cep' => $allData['cep'],
                'logradouro' => $allData['logradouro'],
                'numero' => $allData['numero'],
                'complemento' => $allData['complemento'] ?? null,
                'bairro' => $allData['bairro'],
                'cidade' => $allData['cidade'],
                'estado' => $allData['estado'],
                'tipo' => $allData['tipo_entrega'],
                'instrucoes' => $allData['instrucoes'] ?? null
            ]);

            // Enviar e-mail de confirmação
            try {
                Mail::to($doacao->email)->send(new DonationConfirmation($doacao));
            } catch (\Exception $e) {
                \Log::warning('Erro ao enviar e-mail de confirmação:', [
                    'doacao_id' => $doacao->id,
                    'email' => $doacao->email,
                    'error' => $e->getMessage()
                ]);
            }

            return redirect()->route('donation.status')
                ->with('success', 'Doação registrada com sucesso!');

        } catch (\Exception $e) {
            \Log::error('Erro ao criar doação:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'data' => $allData ?? 'N/A'
            ]);
            
            return redirect()->back()
                ->with('error', 'Erro ao processar doação: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Página de sucesso
    public function success($id)
    {
        $doacao = Doacao::findOrFail($id);
        return view('donation-success', compact('doacao'));
    }

    // Status das doações do usuário
    public function status()
    {
        $userEmail = auth()->user()->email;
        
        // Otimização: Selecionar apenas campos necessários
        $doacoes = Doacao::select([
                'id', 'nome', 'email', 'tipo_doacao', 'valor', 'descricao_itens',
                'status', 'observacoes', 'data_recebimento', 'created_at', 'updated_at',
                'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep'
            ])
            ->where('email', $userEmail)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('donation-status', compact('doacoes'));
    }
}