<?php

namespace App\Http\Controllers;

use App\Ramo;
use App\Sistema;
use App\Support\Collection;
use App\Venda;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ProdutoController. Controlador utilizado para todos os tipos de Produtos.
 * @package App\Http\Controllers
 */
class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Mostra a view adequada ao tipo de Produto. É feita uma verificação de tipo e retornada a view correta.
     *
     * @param Sistema $sistema
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(Sistema $sistema, $id)
    {
        $produto = $sistema->getProdutoHandler()->getProduto($id);
        $isRamo = $produto instanceof Ramo;
        $tipo = 'None';
        if ($isRamo)
            $tipo = 'Ramo';
        else $tipo = 'NotRamo';

        return view('produto.show', compact(['tipo', 'produto']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param  int  $id
 */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Retorna objeto Produto de acordo com o request
     *
     * @param Sistema $sistema
     * @param Venda $venda
     * @param Request $request
     * @return Application|Factory|View
     */
     public function searchProduto(Sistema $sistema, Venda $venda, Request $request)
     {
         $search = $request->search;
         $prods = $sistema->getProdutoHandler()->getProdutos();
         $produtos = collect();
         foreach ($prods as $produto){
             if (strpos(strtolower($produto->descricao),strtolower($search)) !== false){
                 $produtos->push($produto);
             }
         }
         if (count($produtos) == 0){
             return redirect(route('mostrar',[$venda]));
         }
         $produtos = (new Collection($produtos))->paginate(10);

         return view('venda.addShowProdutoVenda',compact('produtos','venda'));
     }

    /**
     * Retorna objeto Produto de acordo com o request, para o Produto Ramo Personalizado
     *
     * @param Sistema $sistema
     * @param Venda $venda
     * @param Ramo $ramo
     * @param Request $request
     * @return Application|Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function searchProdutoRamoPersonalizado(Sistema $sistema, Venda $venda, Ramo $ramo, Request $request)
    {
        $search = $request->search;
        $prods = $sistema->getProdutoHandler()->getProdutosParaRamoPersonalizado();
        $produtos = collect();
        foreach ($prods as $produto){
            if (strpos(strtolower($produto->descricao),strtolower($search)) !== false){
                $produtos->push($produto);
            }
        }
        if (count($produtos) == 0){
            return redirect(route('mostrar',[$venda]));
        }
        $produtos = (new Collection($produtos))->paginate(10);

        return view('venda.ramoPersonalizado',compact('produtos','ramo','venda'));
    }

}
