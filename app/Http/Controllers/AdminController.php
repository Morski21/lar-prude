<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doacao;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationStatusChanged;
use App\Mail\DonationRescheduled;

class AdminController extends Controller
{
    /**
     * Dashboard administrativo
     */
    public function dashboard()
    {
        // Otimização: Uma única consulta para todas as estatísticas
        $statusCounts = Doacao::selectRaw('
            COUNT(*) as total_doacoes,
            SUM(CASE WHEN status = "em_espera" THEN 1 ELSE 0 END) as doacoes_pendentes,
            SUM(CASE WHEN status = "aceita" THEN 1 ELSE 0 END) as doacoes_aceitas,
            SUM(CASE WHEN status = "recebida" THEN 1 ELSE 0 END) as doacoes_recebidas
        ')->first();

        $stats = [
            'total_doacoes' => $statusCounts->total_doacoes,
            'doacoes_pendentes' => $statusCounts->doacoes_pendentes,
            'doacoes_aceitas' => $statusCounts->doacoes_aceitas,
            'doacoes_recebidas' => $statusCounts->doacoes_recebidas,
        ];

        // Buscar doações com paginação otimizada
        $doacoes = Doacao::select(['id', 'nome', 'email', 'tipo_doacao', 'status', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dashboard', compact('stats', 'doacoes'));
    }


    /**
     * Visualizar detalhes de uma doação
     */
    public function showDonation($id)
    {
        $doacao = Doacao::with('endereco')->findOrFail($id);
        return view('admin.donation-details', compact('doacao'));
    }

    /**
     * Aceitar uma doação
     */
    public function acceptDonation($id)
    {
        $doacao = Doacao::findOrFail($id);
        $oldStatus = $doacao->status;
        
        $doacao->update(['status' => 'aceita']);

        // Enviar e-mail de notificação
        try {
            Mail::to($doacao->email)->send(new DonationStatusChanged($doacao, $oldStatus, 'aceita'));
        } catch (\Exception $e) {
            \Log::warning('Erro ao enviar e-mail de mudança de status:', [
                'doacao_id' => $doacao->id,
                'error' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with('success', 'Doação aceita com sucesso!');
    }

    /**
     * Recusar uma doação
     */
    public function refuseDonation(Request $request, $id)
    {
        $doacao = Doacao::findOrFail($id);
        $oldStatus = $doacao->status;
        
        $doacao->update([
            'status' => 'recusada',
            'observacoes' => $request->motivo ?? 'Doação recusada pela administração'
        ]);

        // Enviar e-mail de notificação
        try {
            Mail::to($doacao->email)->send(new DonationStatusChanged($doacao, $oldStatus, 'recusada'));
        } catch (\Exception $e) {
            \Log::warning('Erro ao enviar e-mail de mudança de status:', [
                'doacao_id' => $doacao->id,
                'error' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with('success', 'Doação recusada.');
    }

    /**
     * Reagendar uma doação
     */
    public function rescheduleDonation(Request $request, $id)
    {
        $request->validate([
            'nova_data' => 'nullable|date|after:today',
            'motivo' => 'required|string|max:500'
        ]);

        $doacao = Doacao::findOrFail($id);
        $oldStatus = $doacao->status;
        
        $doacao->update([
            'status' => 'reagendada',
            'observacoes' => $request->motivo
        ]);

        // Enviar e-mail de reagendamento
        try {
            Mail::to($doacao->email)->send(new DonationRescheduled(
                $doacao, 
                $request->nova_data ? \Carbon\Carbon::parse($request->nova_data)->format('d/m/Y') : null,
                $request->motivo
            ));
        } catch (\Exception $e) {
            \Log::warning('Erro ao enviar e-mail de reagendamento:', [
                'doacao_id' => $doacao->id,
                'error' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with('success', 'Doação reagendada com sucesso!');
    }

    /**
     * Marcar doação como recebida
     */
    public function markAsReceived($id)
    {
        $doacao = Doacao::findOrFail($id);
        $oldStatus = $doacao->status;
        
        $doacao->update([
            'status' => 'recebida',
            'data_recebimento' => now()
        ]);

        // Enviar e-mail de confirmação
        try {
            Mail::to($doacao->email)->send(new DonationStatusChanged($doacao, $oldStatus, 'recebida'));
        } catch (\Exception $e) {
            \Log::warning('Erro ao enviar e-mail de mudança de status:', [
                'doacao_id' => $doacao->id,
                'error' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with('success', 'Doação marcada como recebida!');
    }

    /**
     * Atualizar status de uma doação
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:em_espera,aceita,recusada,reagendada,confirmada,recebida,cancelada',
            'observacoes' => 'nullable|string|max:1000'
        ]);

        $doacao = Doacao::findOrFail($id);
        $oldStatus = $doacao->status;
        $newStatus = $request->status;

        $updateData = ['status' => $newStatus];
        
        if ($request->filled('observacoes')) {
            $updateData['observacoes'] = $request->observacoes;
        }

        if ($newStatus === 'recebida') {
            $updateData['data_recebimento'] = now();
        }

        $doacao->update($updateData);

        // Enviar e-mail de notificação se o status mudou
        if ($oldStatus !== $newStatus) {
            try {
                Mail::to($doacao->email)->send(new DonationStatusChanged($doacao, $oldStatus, $newStatus));
            } catch (\Exception $e) {
                \Log::warning('Erro ao enviar e-mail de mudança de status:', [
                    'doacao_id' => $doacao->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return redirect()->back()->with('success', 'Status da doação atualizado com sucesso!');
    }

}
