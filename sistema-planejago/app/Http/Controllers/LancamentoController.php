<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lancamento;
use Carbon\Carbon;

class LancamentoController extends Controller
{
    public function index () {

        $userId = auth()->id();

         $totalReceitas = Lancamento::where('user_id', $userId)
            ->where('tipo_lancamento_id', 2)
            ->sum('valor');
        
        $totalDespesas = Lancamento::where('user_id', $userId)
            ->where('tipo_lancamento_id', 1)
            ->sum('valor');
            
        $saldoTotal = $totalReceitas - $totalDespesas;

         $lancamentos = Lancamento::with(['categoria', 'tipoLancamento'])
            ->where('user_id', $userId)
            ->orderBy('data_vencimento', 'asc')
            ->get();

        return view('lancamentos.home', compact('lancamentos', 'totalReceitas', 'totalDespesas', 'saldoTotal'));
    }

    public function criaDespesa (Request $request) {

        $dadosValidados = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'status' => 'required|in:true,false',
            'categoria' => 'required|integer',
            'frequencia' => 'required|integer',
            'dataCriacao' => 'required|date',
            'dataVencimento' => 'required|date|after_or_equal:dataCriacao',
        ]);

        Lancamento::create([
            'descricao'           => $dadosValidados['descricao'],
            'valor'               => $dadosValidados['valor'],
            'status_pago'         => $dadosValidados['status'] === 'true' ? true : false,
            'data_criacao'        => $dadosValidados['dataCriacao'],
            'data_vencimento'     => $dadosValidados['dataVencimento'],
            
            // Relacionamentos 
            'categoria_id'        => $dadosValidados['categoria'],
            'frequencia_id'       => $dadosValidados['frequencia'],
            'tipo_lancamento_id'  => 1, // Despesa
            'user_id'             => auth()->id(),

            // Logs
            'log_data_inclusao'   => Carbon::now(),
            'log_data_alteracao'  => Carbon::now(),
            'log_versao_registro' => 1, 
        ]);

        return redirect()->route('user.lancamentos')->with('sucesso', 'Despesa registrada com sucesso!');
    }

    public function atualizarStatus(Request $request, $id)
    {
        $lancamento = Lancamento::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $lancamento->status_pago = $request->status; 
        $lancamento->save();

        return response()->json(['success' => true]);
    }


    public function criaReceita(Request $request) 
    {
        $dadosValidados = $request->validate([
            'descricao'   => 'required|string|max:255',
            'valor'       => 'required|numeric|min:0',
            'categoria'   => 'required|integer',
            'frequencia'  => 'required|integer',
            'dataCriacao' => 'required|date',
        ]);

        Lancamento::create([
            'descricao'           => $dadosValidados['descricao'],
            'valor'               => $dadosValidados['valor'],
            'data_criacao'        => $dadosValidados['dataCriacao'],
            
            // Relacionamentos 
            'categoria_id'        => $dadosValidados['categoria'],
            'frequencia_id'       => $dadosValidados['frequencia'],
            'tipo_lancamento_id'  => 2, // 2 = Receita
            'user_id'             => auth()->id(),

            // Logs
            'log_data_inclusao'   => Carbon::now(),
            'log_data_alteracao'  => Carbon::now(),
            'log_versao_registro' => 1, 
        ]);

        return redirect()->route('user.lancamentos')->with('sucesso', 'Receita registrada com sucesso!');
    }

    public function editarDespesa(Request $request, $id) {

        $dadosValidados = $request->validate([
            'descricao'      => 'required|string|max:255',
            'valor'          => 'required|numeric|min:0',
            'status'         => 'required|string', // Vem como 'true' ou 'false' do select
            'categoria'      => 'required|integer',
            'frequencia'     => 'required|integer',
            'dataCriacao'    => 'required|date',
            'dataVencimento' => 'required|date',
        ]);

        $lancamento = Lancamento::where('id', $id)
                                ->where('user_id', auth()->id())
                                ->firstOrFail();

        $lancamento->descricao = $dadosValidados['descricao'];
        $lancamento->valor = $dadosValidados['valor'];

        $lancamento->status_pago = filter_var($dadosValidados['status'], FILTER_VALIDATE_BOOLEAN); 
        
        $lancamento->categoria_id = $dadosValidados['categoria'];
        $lancamento->frequencia_id = $dadosValidados['frequencia'];
        $lancamento->data_criacao = $dadosValidados['dataCriacao'];
        $lancamento->data_vencimento = $dadosValidados['dataVencimento'];

        $lancamento->log_data_alteracao = \Carbon\Carbon::now();
        $lancamento->log_versao_registro += 1;

        $lancamento->save();

        return redirect()->route('user.lancamentos')->with('sucesso', 'Despesa atualizada com sucesso!');
    }

    public function editarReceita(Request $request, $id)
    {
        $dadosValidados = $request->validate([
            'descricao'   => 'required|string|max:255',
            'valor'       => 'required|numeric|min:0',
            'categoria'   => 'required|integer',
            'frequencia'  => 'required|integer',
            'dataCriacao' => 'required|date',
        ]);

        $lancamento = Lancamento::where('id', $id)
                                ->where('user_id', auth()->id())
                                ->firstOrFail();

        $lancamento->descricao = $dadosValidados['descricao'];
        $lancamento->valor = $dadosValidados['valor'];
        $lancamento->categoria_id = $dadosValidados['categoria'];
        $lancamento->frequencia_id = $dadosValidados['frequencia'];
        $lancamento->data_criacao = $dadosValidados['dataCriacao'];

        $lancamento->log_data_alteracao = \Carbon\Carbon::now();
        $lancamento->log_versao_registro += 1;

        $lancamento->save();

        return redirect()->route('user.lancamentos')->with('sucesso', 'Receita atualizada com sucesso!');
    }

    public function deletar($id)
    {
        $lancamento = Lancamento::where('id', $id)
                                ->where('user_id', auth()->id())
                                ->firstOrFail();

        $lancamento->delete();

        return redirect()->route('user.lancamentos')->with('sucesso', 'Lançamento excluído com sucesso!');
    }


}
