<?php


namespace App;


/**
 * Class GerirProdutoHandler
 * @package App
 */
class GerirProdutoHandler
{
    /**
     * @var CatalogProdutos
     */
    private CatalogProdutos $catalogProdutos;

    /**
     * GerirProdutoHandler constructor
     *
     * @param CatalogProdutos $catalogProdutos
     */
    public function __construct(CatalogProdutos $catalogProdutos)
    {
        $this->catalogProdutos = $catalogProdutos;
    }

    /**
     * Obtem e retorna objeto Produto
     *
     * @param $codProduto
     * @return mixed
     * @throws \Exception
     */
    public function getProduto($codProduto)
    {
        return $this->catalogProdutos->getProduto($codProduto);
    }

    /**
     * Obtem e retorna lista de Produtos
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProdutos()
    {
        return $this->catalogProdutos->getProdutos();
    }

    /**
     * Adiciona e retorna objeto de Produto Ramo, com atributo personalizado
     *
     * @param $codProduto
     * @return Ramo
     */
    public function addRamoPersonalizado($codProduto)
    {
        return $this->catalogProdutos-> addRamoPersonalizado($codProduto);
    }

    /**
     * Obtem e retorna o ID do ultimo produto inserido
     *
     * @return mixed
     */
    public function lastInsertedId()
    {
        return $this->catalogProdutos->lastInsertedId();
    }

    /**
     * Obtem e rnetorna Produtos para Ramo Personalizado
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProdutosParaRamoPersonalizado()
    {
        return $this->catalogProdutos->getProdutosParaRamoPersonalizado();
    }

    /**
     * Verifica que existe objeto Ramo e apaga objeto Ramo, com atributo personalizado
     *
     * @param Ramo $ramo
     * @throws \Exception
     */
    public function deleteRamoPersonalizado(Ramo $ramo)
    {
        $in = $this->catalogProdutos->verificaExisteRamo($ramo);
        if ($in){
            $this->catalogProdutos->deleteRamoPersonalizado($ramo);
        }
    }

    /**
     * Obtem lista de Produtos ArtigoRamo, verifica a existencia deste Produto e repõe Stock para cada um
     *
     * @param $ramo
     * @throws \Exception
     */
    public function deleteProdutosArtigoRamo($ramo){
        $artigosramo = $this->catalogProdutos->getArtigosRamo($ramo);
        foreach ($artigosramo as $ar){
            $produto = $this->catalogProdutos->getProduto($ar->codProduto);
            $this->catalogProdutos->reporStock($produto,$ar->quantidade);
        }
    }


}
