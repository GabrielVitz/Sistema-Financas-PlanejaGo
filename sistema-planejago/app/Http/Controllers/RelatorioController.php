<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoLancamento;
use App\Models\Categoria;
use App\Models\Lancamento;
use Carbon\Carbon;

class RelatorioController extends Controller
{
    public function index(Request $request) {

        $tipo_lancamentos = TipoLancamento::all();
        $categorias = Categoria::all();
 
        $query = Lancamento::where('user_id', auth()->id());
 
        if ($request->filled('periodo')) {
            $agora = Carbon::now();
            switch ($request->periodo) {
                case 'hoje':
                    $query->whereDate('data_criacao', $agora->toDateString());
                    break;
                case 'semana':
                    $query->whereBetween('data_criacao', [
                        $agora->copy()->startOfWeek()->toDateString(),
                        $agora->copy()->endOfWeek()->toDateString(),
                    ]);
                    break;
                case 'mes':
                    $query->whereMonth('data_criacao', $agora->month)
                          ->whereYear('data_criacao', $agora->year);
                    break;
            }
        }
 
        if ($request->filled('tipo_lancamento_id')) {
            $query->where('tipo_lancamento_id', $request->tipo_lancamento_id);
        }
 
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }
 
        if ($request->has('status_pago') && trim($request->status_pago) !== '') {
            $query->where('status_pago', $request->status_pago);
        }
 
        $lancamentosFiltrados = $query->get();
 
        $graficoPizzaLabels = [];
        $graficoPizzaSeries = [];
 
        $agrupadoPorCategoria = $lancamentosFiltrados->groupBy('categoria_id');
        foreach ($agrupadoPorCategoria as $categoriaId => $lancamentos) {
            $nomeCategoria = $categorias->where('id', $categoriaId)->first()->titulo ?? 'Outros';
            $graficoPizzaLabels[] = $nomeCategoria;
            $graficoPizzaSeries[] = (float) $lancamentos->sum('valor');
        }
 
        $graficoLinhaSeries = [0, 0, 0, 0, 0, 0, 0];
 
        foreach ($lancamentosFiltrados as $lancamento) {
            $data = Carbon::parse($lancamento->data_criacao);
            $indiceDia = $data->dayOfWeekIso - 1;
            $graficoLinhaSeries[$indiceDia] += $lancamento->valor;
        }
 
        return view('relatorio.index', compact(
            'tipo_lancamentos',
            'categorias',
            'lancamentosFiltrados',
            'graficoPizzaLabels',
            'graficoPizzaSeries',
            'graficoLinhaSeries'
        ));
    }
}
