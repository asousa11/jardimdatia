<?php


namespace App;

use Exception;
use function GuzzleHttp\Psr7\str;

class CatalogProdutos
{
    /**
     * CatalogPrtodutos constructor.
     */
    public function __construct()
    {
    }

    /**
     * Retorna uma coleção ordenada de produtos, excetuando Ramos personalizados. Ret
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProdutos()
    {
        $extras = Extra::all();
        $prodManutencao = ProdutoManutencao::all();
        $flores = Flor::all();
        $ramos = Ramo::all()->where ('personalizavel','=','0')->all();

        $produtos = collect();
        $produtos = $produtos->concat($extras);
        $produtos = $produtos->concat($prodManutencao);
        $produtos = $produtos->concat($flores);
        $produtos = $produtos->concat($ramos);

        return $produtos->sortBy('codProduto');
    }

    /**
     * Obtem e retorna objeto Produto, verificando a existencia de stock em função do parametro (quantidade)
     *
     * @param $codProduto
     * @param $qt
     * @return mixed
     * @throws Exception
     */
    public function verificaExisteProdutoEStock($codProduto, $qt)
    {
        $produto = $this->getProduto($codProduto);
        $this->verificaExistenciaStock($produto,$qt);
        return $produto;
    }

    /**
     * Verifica a existencia de stock para determinado objeto Produto, e retorn um boolean
     *
     * @param $produto
     * @param $qt
     * @return bool
     * @throws Exception
     */
    public function verificaExistenciaStock($produto,$qt)
    {
        if ($produto->quantidade_stock >= $qt){
            return true;
        }
        else{
            throw new Exception("Quantidade Insuficiente");
        }
    }

    /**
     * Obtem e retorna objeto Produto em função de lista de Produtos
     *
     * @param $codProduto
     * @return mixed
     * @throws Exception
     */
    public function getProduto($codProduto)
    {
        $produtos = $this->getAllProdutos();
        foreach ($produtos as $produto){
            if($produto->codProduto == $codProduto){
                return $produto;
            }
        }
        throw new Exception("Produto Inexistente");
    }

    /**
     * Adiciona e persiste obbjeto Ramo, com atributo personalizavel a True
     *
     * @param $codProduto
     * @return Ramo
     */
    public function addRamoPersonalizado($codProduto)
    {
        $rp = new Ramo();
        $rp->codProduto = $codProduto;
        $rp->personalizavel = true;
        $rp->descricao = 'Ramo Personalizado ' . strval($codProduto);
        $rp->preco = 0;
        $rp->quantidade_stock = 1;
        $rp->promocao_id = 9;
        $rp->save();
        return $rp;
    }

    /**
     * Obtem e retorna coleção ordenada de todos os Produtos
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllProdutos()
    {
        $extras = Extra::all();
        $prodManutencao = ProdutoManutencao::all();
        $flores = Flor::all();
        $ramos = Ramo::all();

        $produtos = collect();
        $produtos = $produtos->concat($extras);
        $produtos = $produtos->concat($prodManutencao);
        $produtos = $produtos->concat($flores);
        $produtos = $produtos->concat($ramos);

        return $produtos->sortBy('codProduto');
    }

    /**
     * retorna o ID do ultimo objeto Produto inserido
     *
     * @return mixed
     */
    public function lastInsertedId()
    {
        $produtos = $this->getAllProdutos();
        $produto = $produtos->last();
        return $produto->codProduto;
    }

    /**
     * Verifica e retorna a existencia de objeto Ramo.
     *
     * @param $ramo
     * @return mixed
     * @throws Exception
     */
    public function verificaExisteRamo($ramo)
    {
        $in = Ramo::find($ramo->codProduto);
        if (!$in){
            throw new Exception("Ramo Inexistente");
        }
        return $in;
    }

    /**
     * Repoe Stock de Produto, em função de parametro (quantidade)
     *
     * @param $produto
     * @param $qt
     */
    public function reporStock($produto,$qt)
    {
        $produto->quantidade_stock += $qt;
        $produto->save();
    }

    /**
     * Remove Stock de Produto, em função de parametro (quantidade)
     *
     * @param $produto
     * @param $qt
     */
    public function removeStock($produto,$qt)
    {
        $produto->quantidade_stock -= $qt;
        $produto->save();
    }

    /**
     * Obtem e retorna coleção de Produtos para Ramo Personalizado
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProdutosParaRamoPersonalizado()
    {
        $extras = Extra::all();
        $flores = Flor::all();

        $produtos = collect();
        $produtos = $produtos->concat($extras);
        $produtos = $produtos->concat($flores);

        return $produtos->sortBy('codProduto');
    }

    /**
     * Obtem e retorna objeto VendaProduto. verifica previamente a existencia do mesmo.
     *
     * @param $idVendaProduto
     * @return mixed
     * @throws Exception
     */
    public function getVendaProduto($idVendaProduto)
    {
        $vp = VendaProduto::find($idVendaProduto);
        if (!$vp){
            throw new Exception("Venda Produto Inexistente");
        }
        return $vp;
    }

    /**
     * Apaga objeto Ramo, com atributo personalizavel a True
     *
     * @param Ramo $ramo
     * @throws Exception
     */
    public function deleteRamoPersonalizado(Ramo $ramo)
    {
        $ramo->delete();
    }

    /**
     * Obtem e retorna objetos ArtigosRamo, com uma relação ao objeto Ramo em parametro.
     *
     * @param $ramo
     * @return mixed
     */
    public function getArtigosRamo($ramo)
    {
        return $ramo->artigoRamo;
    }

    /**
     * Verifica e retorna objeto ArtigoRamo
     *
     * @param $idArtigoRamo
     * @return mixed
     * @throws Exception
     */
    public function verificaArtigoRamo($idArtigoRamo)
    {

        $ar = ArtigoRamo::find($idArtigoRamo);
        if (!$ar){
            throw new Exception("Artigo Ramo Inexistente");
        }
        return $ar;
    }
}
