<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Ramo;
use App\Sistema;
use App\Support\Collection;
use App\Venda;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class VendaController
 * @package App\Http\Controllers
 */
class VendaController extends Controller
{
    /**
     * Mostra todas as Vendas.
     *
     * @param Sistema $sistema
     * @return Application|Factory|View
     */
    public function index(Sistema $sistema)
    {
        $vendas = $sistema->getVendasHandler()->getVendas();
        return view('venda.index',compact('vendas'));
    }

    /**
     * Mostra o formulário para criar uma nova Venda.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view ('venda.create');
    }

    /**
     * Guarda a nova Venda após submissão do formulário.
     *
     * @param Sistema $sistema
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Sistema $sistema)
    {
        request()->validate([
            'contribuinte' => 'required | size:9'
        ]);

        $sistema->getVendasHandler()->addVenda(request()->contribuinte);
        return redirect(route('vendas.index'));
    }

    /**
     * Mostra uma venda especifica.
     *
     * @param Sistema $sistema
     * @param Venda $venda
     * @return Application|Factory|View
     */
    public function show(Sistema $sistema, Venda $venda)
    {
        $venda = $sistema->getVendasHandler()->verificaExisteVenda($venda);
        return view('venda.show',compact('venda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Venda $venda
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Sistema $sistema
     * @param Request $request
     * @param Venda $venda
     * @return void
     */
    public function update(Sistema $sistema, Request $request, Venda $venda)
    {
        //
    }

    /**
     * Remove a Venda selecionada.
     *
     * @param Sistema $sistema
     * @param Venda $venda
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Sistema $sistema, Venda $venda)
    {
        $sistema->getVendasHandler()->deleteVenda($venda);
        return redirect(route('vendas.index'));
    }

    /**
     * Retorna para View, os objetos Produto disponiveis para Venda
     *
     * @param Sistema $sistema
     * @param Venda $venda
     * @return Application|Factory|View
     */
    public function showProdutos(Sistema $sistema, Venda $venda)
    {
        $produtos = $sistema->getProdutoHandler()->getProdutos();
        $produtos = (new Collection($produtos))->paginate(10);

        return view('venda.addShowProdutoVenda',compact('produtos','venda'));
    }

    /**
     * Adiciona objeto VendaProduto e adiciona ou actualiza objeto Produto
     * @param Sistema $sistema
     * @param Venda $venda
     * @param $codProduto
     * @return RedirectResponse
     */
    public function adicionarVendaProduto(Sistema $sistema, Venda $venda, $codProduto)
    {
        request()->validate([
            'qt' => 'gt:0'
        ]);

        $sistema->getVendasHandler()->addVendaProduto($venda, $codProduto, request('qt'));
        return redirect(route('mostrar', [$venda]));
    }

    /**
     * Apresenta o resumo de uma Venda sem recurso ao saldo em Cartao Cliente.
     * @param Venda $venda
     * @return Application|Factory|View
     */
    public function resumoVendaSemCartao(Venda $venda)
    {
        return view('venda.resumoVendaSemCartao',compact('venda'));
    }

    /**
     * Apresenta o resumo de uma Venda com recuso ao Saldo em Cartao Cliente.
     * @param Venda $venda
     * @return Application|Factory|View
     */
    public function resumoVendaComCartao(Venda $venda)
    {
        return view('venda.resumoVendaComCartao',compact('venda'));
    }

    /**
     * Finaliza uma Venda sem recurso ao saldo em Cartao Cliente.
     * @param Sistema $sistema
     * @param Venda $venda
     * @return Application|RedirectResponse|Redirector
     */
    public function finalizarVendaSemCartao(Sistema $sistema, Venda $venda)
    {
        $sistema->getVendasHandler()->finalizarVendaSemCartao($venda);
        return redirect(route('vendas.index'));
    }

    /**
     * Finaliza uma Venda com recuso ao Saldo em Cartao Cliente
     * @param Sistema $sistema
     * @param Venda $venda
     * @return Application|RedirectResponse|Redirector
     */
    public function finalizarVendaComCartao(Sistema $sistema, Venda $venda)
    {
        $sistema->getVendasHandler()->finalizarVendaComCartao($venda);
        return redirect(route('vendas.index'));
    }

    /**
     * Elimina um Produto de objeto Venda Produto
     * @param Sistema $sistema
     * @param Venda $venda
     * @param $idVendaProduto
     * @return Application|RedirectResponse|Redirector
     */
    public function eliminarVendaProduto(Sistema $sistema, Venda $venda, $idVendaProduto)
    {
        $sistema->getVendasHandler()->eliminarVendaProduto($venda, $idVendaProduto);
        return redirect(route('mostrar',$venda));
    }

    /**
     * Disponibiliza a view para criar um ramo personalizado.
     * @param Sistema $sistema
     * @param Venda $venda
     * @return Application|RedirectResponse|Redirector
     */
    public function createRamoPersonalizado(Sistema $sistema, Venda $venda)
    {
        $codProduto = $sistema->getProdutoHandler()->lastInsertedId() + 1;
        $ramoPersonalizado = $sistema->getProdutoHandler()->addRamoPersonalizado($codProduto);
        return redirect(route('showRamoPersonalizado',[$venda,$ramoPersonalizado->codProduto]));
    }

    /**
     * Mostra view para adicionar produtos ao Ramo personalizado.
     * @param Sistema $sistema
     * @param Venda $venda
     * @param Ramo $ramo
     * @return Application|Factory|View
     */
    public function showRamoPersonalizado(Sistema $sistema, Venda $venda, Ramo $ramo)
    {
        $produtos = $sistema->getProdutoHandler()->getProdutosParaRamoPersonalizado();
        $produtos = (new Collection($produtos))->paginate(10);
        return view('venda.ramoPersonalizado',compact('venda','ramo','produtos'));
    }

    /**
     * Adiciona um artigo (Produto) ao Ramo personalizado.
     * @param Sistema $sistema
     * @param Ramo $ramo
     * @param $codProduto
     * @return RedirectResponse
     */
    public function adicionarArtigoRamo(Sistema $sistema, Ramo $ramo, $codProduto)
    {
        request()->validate([
            'qt' => 'gt:0'
        ]);

        $sistema->getVendasHandler()->addArtigoRamo($ramo, $codProduto, request('qt'));
        return back();
    }

    /**
     * Elimina um artigo (Produto) ao Ramo personalizado.
     * @param Sistema $sistema
     * @param Venda $venda
     * @param Ramo $ramo
     * @param $idArtigoRamo
     * @return Application|RedirectResponse|Redirector
     */
    public function eliminarArtigoRamo(Sistema $sistema, Venda $venda, Ramo $ramo, $idArtigoRamo)
    {
        $sistema->getVendasHandler()->eliminarArtigoRamo($ramo, $idArtigoRamo);
        return redirect(route('showRamoPersonalizado',[$venda,$ramo]));
    }

    /**
     * Elimina um ramo personalizado.
     * @param Sistema $sistema
     * @param Venda $venda
     * @param Ramo $ramo
     * @return Application|RedirectResponse|Redirector
     */
    public function eliminarRamoPersonalizado(Sistema $sistema, Venda $venda, Ramo $ramo)
    {
        $sistema->getProdutoHandler()->deleteProdutosArtigoRamo($ramo);
        $sistema->getProdutoHandler()->deleteRamoPersonalizado($ramo);
        return redirect(route('mostrar',$venda));
    }

    /**
     * Apresenta uma view com os artigos que estão no Ramo.
     * @param Venda $venda
     * @param Ramo $ramo
     * @return Application|Factory|View
     */
    public function resumoRamoPersonalizado(Venda $venda, Ramo $ramo)
    {
        return view('venda.resumoRamoPersonalizado', compact('venda','ramo'));
    }

    /**
     * Dá por terminada a criação de um ramo personalizado e adiciona-o à venda.
     * @param Sistema $sistema
     * @param Venda $venda
     * @param Ramo $ramo
     * @return Application|RedirectResponse|Redirector
     */
    public function finalizarRamoPersonalizado(Sistema $sistema, Venda $venda, Ramo $ramo)
    {
        $sistema->getVendasHandler()->addVendaProduto($venda,$ramo->codProduto, $ramo->quantidade_stock);
        return redirect(route('mostrar',[$venda]));
    }

    /**
     * Retorna objeto Venda de acordo com o request
     *
     * @param Sistema $sistema
     * @param Request $request
     * @return Application|Factory|View
     */
    public function searchVenda(Sistema $sistema, Request $request)
    {
        $search = $request->get('search');
        $vendas = $sistema->getVendasHandler()->searchVenda($search);
        if (count($vendas) == 0){
            return redirect(route('vendas.index'));
        }
        return view('venda.index',compact('vendas'));
    }

}
