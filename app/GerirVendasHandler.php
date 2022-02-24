<?php


namespace App;


use function GuzzleHttp\Promise\promise_for;

class GerirVendasHandler
{

    private CatalogVendas $catalogVendas;
    private CatalogClientes $catalogClientes;
    private CatalogProdutos $catalogProdutos;

    /**
     * GerirVendasHandler constructor.
     * @param CatalogVendas $vendasCatalog
     */
    public function __construct(CatalogVendas $catalogVendas, CatalogClientes $catalogClientes, CatalogProdutos $catalogProdutos)
    {
        $this->catalogVendas = $catalogVendas;
        $this->catalogClientes = $catalogClientes;
        $this->catalogProdutos = $catalogProdutos;
    }

    /**
     * Obtem e retorna objetos Venda
     *
     * @return Venda[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getVendas()
    {
        return $this->catalogVendas->getVendas();
    }

    /**
     * Verifica e obtem objeto Cliente, e cria objeto Venda, criando relação entre objetos
     *
     * @param $numContribuinte
     * @throws \Exception
     */
    public function addVenda($numContribuinte){
        $cliente = $this->catalogClientes->getCliente($numContribuinte);
        $this->catalogVendas->addVenda($cliente);
    }

    /**
     * Verifica a existencia de Venda
     *
     * @param $venda
     * @return mixed
     */
    public function verificaExisteVenda($venda)
    {
        return $this->catalogVendas->getVenda($venda);
    }

    /**
     * Obtem e Actualiza o estado de objeto Venda
     *
     * @param $venda
     * @param $aberta
     */
    public function updateVenda($venda,$aberta)
    {
        $this->verificaExisteVenda($venda);
        $this->catalogVendas->updateVenda($venda, $aberta);
    }

    /**
     * Verifica e Apaga objeto Venda
     *
     * @param $venda
     */
    public function deleteVenda($venda)
    {
        $this->verificaExisteVenda($venda);
        $this->catalogVendas->deleteVenda($venda);
    }

    /**
     * Verifica a existencia de objeto Venda. Verifia a existencia e stock de objeto Produto.
     * Verifica a exitencia e stock de objeto Produto
     * Verifica a existencia de objeto VendaProduto, que em funcção do obtido permite criar ou atualizar objeto VendaProduto
     *
     * @param $venda
     * @param $codProduto
     * @param $qt
     * @throws \Exception
     */
    public function addVendaProduto($venda, $codProduto, $qt)
    {
        $this->catalogVendas->getVenda($venda);
        $produto = $this->catalogProdutos->verificaExisteProdutoEStock($codProduto,$qt);
        $in = $this->catalogVendas->verificaSeVendaProdutoExiste($venda,$produto);

        if (!$in){
            $this->catalogVendas->addVendaProduto($venda,$produto,$qt);
            $this->catalogProdutos->removeStock($produto,$qt);
        }else{
            $this->catalogVendas->updateVendaProduto($venda,$produto,$qt);
            $this->catalogProdutos->removeStock($produto,$qt);
        }
    }

    /**
     * Finaliza Venda Sem Cartão Cliente
     *
     * @param $venda
     */
    public function finalizarVendaSemCartao($venda){
        $this->catalogVendas->getVenda($venda);
        $this->catalogVendas->fecharVendaSemCartao($venda);
    }

    /**
     * Finaliza Venda Com Cartão Cliente
     *
     * @param $venda
     */
    public function finalizarVendaComCartao($venda){
        $this->catalogVendas->getVenda($venda);
        $this->catalogVendas->fecharVendaComCartao($venda);
    }

    /**
     * @param $idVendaProduto
     *
     * Repõe stock de Produto e elimina Venda Produto
     */
    public function eliminarVendaProduto($venda, $idVendaProduto)
    {
        $vp = $this->catalogProdutos->getVendaProduto($idVendaProduto);
        $produto = $this->catalogProdutos->getProduto($vp->codProduto);
        if (class_basename($produto) == 'Ramo' && $produto->personalizavel == 1){
            $ar = $produto->artigoRamo;
            $this->eliminarArtigoRamo($produto,$ar[0]->id);
            $this->catalogVendas->eliminarVendaProduto($venda,$vp);
            $this->catalogProdutos->deleteRamoPersonalizado($produto);
        }else{
            $this->catalogProdutos->reporStock($produto, $vp->quantidade);
            $this->catalogVendas->eliminarVendaProduto($venda,$vp);
        }
    }

    /**
     * Verifica a existencia de objeto Ramo
     * Verifica a exitencia e stock de objeto Produto
     * Verifica a existencia de objeto ArtigoRamo, que em funcção do obtido permite criar ou atualizar objeto ArtigoRamo
     *
     * @param Ramo $ramo
     * @param $codProduto
     * @param $qt
     * @throws \Exception
     */
    public function addArtigoRamo(Ramo $ramo, $codProduto, $qt)
    {
        $this->catalogProdutos->verificaExisteRamo($ramo);
        $produto = $this->catalogProdutos->verificaExisteProdutoEStock($codProduto,$qt);
        $in = $this->catalogVendas->verificaExisteArtigoEmArtigoRamo($ramo,$produto);

        if (!$in){
            $this->catalogVendas->addArtigoRamo($ramo,$produto,$qt);
            $this->catalogProdutos->removeStock($produto,$qt);
        }else{
            $this->catalogVendas->updateArtigoRamo($ramo,$produto,$qt);
            $this->catalogProdutos->removeStock($produto,$qt);
        }
    }

    /**
     * Verfica a existencia de objeto ArtigoRamo
     * Verifica a existencia de objeto Produto
     * Repoe Stck de Produto e elimina objeto ArtigoRamo
     *
     *
     *
     * @param $ramo
     * @param $idArtigoRamo
     * @throws \Exception
     */
    public function eliminarArtigoRamo($ramo,$idArtigoRamo)
    {
        $ar = $this->catalogProdutos->verificaArtigoRamo($idArtigoRamo);
        $produto = $this->catalogProdutos->getProduto($ar->codProduto);
        $this->catalogProdutos->reporStock($produto,$ar->quantidade);
        $this->catalogVendas->eliminarArtigoRamo($ramo, $ar);
    }

    /**
     * Retorna objetos Vendas de acordo com o parametro
     * @param $search
     */
    public function searchVenda($search)
    {
        return $this->catalogVendas->searchVenda($search);
    }


}
