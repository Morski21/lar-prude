<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doacao;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Buscar estatísticas das doações do usuário
        $doacoes = Doacao::where('email', $user->email)->get();
        
        $totalDoacoes = $doacoes->count();
        $doacoesAceitas = $doacoes->where('status', 'aceita')->count();
        $doacoesRecebidas = $doacoes->where('status', 'recebida')->count();
        $doacoesEmEspera = $doacoes->where('status', 'em_espera')->count();
        $totalValor = $doacoes->where('tipo_doacao', 'dinheiro')->sum('valor');
        
        return view('account', compact(
            'totalDoacoes',
            'doacoesAceitas', 
            'doacoesRecebidas',
            'doacoesEmEspera',
            'totalValor'
        ));
    }
}