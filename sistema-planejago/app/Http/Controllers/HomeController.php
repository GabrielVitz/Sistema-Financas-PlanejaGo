<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Lancamento;

class HomeController extends Controller
{
    public function index () {
        return view('home.home');
    }

    public function dashboard()
    {
        $userId = Auth()->id();
        $anoAtual = date('Y');

        $totalReceitas = \App\Models\Lancamento::where('user_id', $userId)
            ->where('tipo_lancamento_id', 2)
            ->sum('valor');
        
        $totalDespesas = \App\Models\Lancamento::where('user_id', $userId)
            ->where('tipo_lancamento_id', 1)
            ->sum('valor');
            
        $saldoTotal = $totalReceitas - $totalDespesas;

        // 1. DADOS GRÁFICO PRINCIPAL: Agrupando por mês do ano atual
        $movimentacoes = Lancamento::selectRaw('MONTH(data_criacao) as mes, tipo_lancamento_id, SUM(valor) as total')
            ->where('user_id', $userId)
            ->whereYear('data_criacao', $anoAtual)
            ->groupBy('mes', 'tipo_lancamento_id')
            ->get();

        $meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        $dadosReceitas = array_fill(0, 12, 0);
        $dadosDespesas = array_fill(0, 12, 0);

        foreach ($movimentacoes as $mov) {
            $indiceMes = $mov->mes - 1; 
            if ($mov->tipo_lancamento_id == 2) { // 2 = Receita
                $dadosReceitas[$indiceMes] = (float) $mov->total;
            } else { // 1 = Despesa
                $dadosDespesas[$indiceMes] = (float) $mov->total;
            }
        }

        // 2. DADOS GRÁFICO MENOR: Top 5 Categorias de Despesas
        $despesasPorCategoria = Lancamento::with('categoria')
            ->selectRaw('categoria_id, SUM(valor) as total')
            ->where('user_id', $userId)
            ->where('tipo_lancamento_id', 1)
            ->groupBy('categoria_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $labelsCategorias = [];
        $dadosCategorias = [];
        
        foreach ($despesasPorCategoria as $despesa) {
            $labelsCategorias[] = $despesa->categoria->titulo ?? 'Outros';
            $dadosCategorias[] = (float) $despesa->total;
        }

        return view('home.dashboard', compact(
            'meses', 'dadosReceitas', 'dadosDespesas',
            'labelsCategorias', 'dadosCategorias',
            // Adicione as três variáveis novas aqui embaixo:
            'totalReceitas', 'totalDespesas', 'saldoTotal'
        ));
    }
}
