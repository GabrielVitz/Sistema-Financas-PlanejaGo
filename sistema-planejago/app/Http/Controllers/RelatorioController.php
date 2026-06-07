<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoLancamento;
use App\Models\Categoria;

class RelatorioController extends Controller
{
    public function index() {

        $tipo_lancamentos = TipoLancamento::all();  
        $categorias = Categoria::all();
        

        return view('relatorio.index', compact('tipo_lancamentos','categorias'));
    }
}
