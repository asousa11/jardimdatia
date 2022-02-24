<?php


namespace App;

class CatalogVendas
{
    /**
     * CatalogVendas constructor.
     */
    public function __construct()
    {
    }

    /**
     * Obtem e retorna coleção ordenada de objetos Venda
     *
     * @return Venda[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getVendas()
    {
        return Venda::orderBy('created_at', 'DESC')->paginate(10);
    }

    /**
     * Adiciona, persiste e associa objeto Venda a Cliente
     *
     * @param $cliente
     */
    public function addVenda($cliente)
    {
        $venda = new Venda();
        $venda -> cliente() -> associate($cliente);
        $venda->premio_id=1;
        $venda -> save();
    }

    /**
     * Verifica, obtem e retorna objeto Venda
     *
     * @param $venda
     * @return mixed
     */
    public function getVenda($venda)
    {
        $sell = Venda::find($venda -> id);
        if (!$sell) {
            throw new Exception("Venda Inexistente");
        }
        return $sell;
    }

    /**
     * Actualiza parametro aberta de objeto Venda
     *
     * @param $venda
     * @param $aberta
     */
    public function updateVenda($venda, $aberta)
    {
        $venda -> aberta = $aberta;
        $venda -> save();
    }

    /**
     * Apaga objeto Venda
     *
     * @param $venda
     */
    public function deleteVenda($venda)
    {
        $venda -> delete();
    }


    /**
     * Adiciona novo objeto VendaProduto
     *
     * @param $venda
     * @param $produto
     * @param $qt
     */
    public function addVendaProduto($venda, $produto, $qt)
    {
        $vp = new VendaProduto();
        $vp -> venda_id = $venda -> id;
        $vp -> codProduto = $produto -> codProduto;
        $vp -> descricao = $produto -> descricao;
        $vp -> preco = $produto -> preco;
        $vp -> quantidade = $qt;

        $this->setPrecoEDescontoVenda($vp,$venda,$produto,$qt);

        $vp -> save();
        $venda -> save();
    }

    /**
     * Atualiza objeto VendaProduto
     *
     * @param $venda
     * @param $produto
     * @param $qt
     */
    public function updateVendaProduto($venda, $produto, $qt)
    {
        foreach ($venda -> vendaProduto as $vp) {
            if ($vp -> codProduto == $produto -> codProduto) {
                $vp -> quantidade += $qt;

                $this->setPrecoEDescontoVenda($vp,$venda,$produto,$qt);
            }
        }
        $vp -> update();
        $venda -> update();
    }

    /**
     * Atribui total, preco e desconto a objeto Venda
     *
     * @param $vp
     * @param $venda
     * @param $produto
     * @param $qt
     */
    public function setPrecoEDescontoVenda($vp,$venda,$produto,$qt)
    {
        $venda -> total += $produto -> preco * $qt;
        if ($produto -> promocao && $produto->promocao->datainicio <= now() && $produto->promocao->datafim >= now()) {
            $this->setDescontoVenda($venda,$produto,$qt);
            $this->setDescontoVendaProduto($vp,$produto);
        }
    }

    /**
     * Atribui valor de Desconto a objeto Venda
     *
     * @param $venda
     * @param $produto
     * @param $qt
     */
    public function setDescontoVenda($venda,$produto,$qt)
    {
        $venda -> descontoTotal += $produto -> preco * $qt * ($produto -> promocao -> percentagem / 100);
    }

    /**
     * Atribui valor percentual a objeto VendaProduto
     *
     * @param $vp
     * @param $produto
     */
    public function setDescontoVendaProduto($vp,$produto)
    {
        $vp -> percentagemPromo = $produto -> promocao -> percentagem;
    }

    /**
     * Fecha Venda sem recurso ao saldo acumulado em cartão
     *
     * @param $venda
     */
    public function fecharVendaSemCartao($venda)
    {
        if (!$venda->cliente->cartao) {
            $venda->aberta = false;
        } else {
            $venda->aberta = false;
            $cartao = $venda->cliente->cartao;
            $cartao->consumoAcumulado += $venda->total;
            if ($cartao->consumoUsado == 0 && $cartao->consumoAcumulado >= $venda->premio->volumeNegocio) {

                $cartao->saldoAcumulado += floor($cartao->consumoAcumulado / $venda->premio->volumeNegocio) * $venda->premio->oferta;
                $cartao->consumoUsado += floor($cartao->consumoAcumulado / $venda->premio->volumeNegocio) * $venda->premio->volumeNegocio;
            } elseif ($cartao -> consumoUsado != 0) {
                if (floor($cartao -> consumoAcumulado / $cartao->consumoUsado) >= 1.0 && $cartao -> consumoAcumulado - $cartao -> consumoUsado >= $venda->premio->volumeNegocio) {
                    $cartao->consumoAcumulado += floor(($cartao -> consumoAcumulado - $cartao->consumoUsado) / $venda->premio->volumeNegocio) * $venda->premio->oferta;
                    $cartao->consumoUsado += floor(($cartao -> consumoAcumulado - $cartao->consumoUsado) / $venda->premio->volumeNegocio) * $venda->premio->volumeNegocio;
                }
            }
            $cartao -> save();
        }
        $venda -> save();
    }

    /**
     * Fecha Venda com recurso ao saldo acumulado em cartão
     *
     * @param $venda
     */
    public function fecharVendaComCartao($venda)
    {
        $venda->aberta = false;
        $cartao = $venda->cliente->cartao;
        $cartao->consumoAcumulado += $venda -> total;

        if ($venda->total >= $cartao->saldoAcumulado) {
            $cartao->saldoAcumulado = 0;
        } else {
            $cartao->saldoAcumulado = $cartao->saldoAcumulado - $venda->total;
        }

        if ($cartao->consumoUsado == 0 && $cartao->consumoAcumulado >= $venda->premio->volumeNegocio) {
            $cartao->saldoAcumulado += floor($cartao->consumoAcumulado / $venda->premio->volumeNegocio) * $venda->premio->oferta;
            $cartao->consumoUsado += floor($cartao->consumoAcumulado / $venda->premio->volumeNegocio) * $venda->premio->volumeNegocio;
        } elseif ($cartao->consumoUsado != 0) {
            if (floor($cartao -> consumoAcumulado / $cartao->consumoUsado) >= 1.0 && $cartao->consumoAcumulado - $cartao->consumoUsado >= $venda->premio->volumeNegocio) {
                $cartao->saldoAcumulado += floor(($cartao->consumoAcumulado - $cartao->consumoUsado) / $venda->premio->volumeNegocio) * $venda->premio->oferta;
                $cartao->consumoUsado += floor(($cartao->consumoAcumulado - $cartao->consumoUsado) / $venda->premio->volumeNegocio) * $venda->premio->volumeNegocio;
            }
        }
        $cartao -> save();
        $venda -> save();
    }

    /**
     * Elimina VendaProduto e atribui valores actualiados a atributos de Venda
     *
     * @param $idVendaProduto
     * Elimina objeto Venda Produto
     */
    public function eliminarVendaProduto($venda, $vp)
    {
        $venda -> total -= $vp -> quantidade * $vp -> preco;
        $venda -> descontoTotal -= $vp -> preco * $vp -> quantidade * ($vp -> percentagemPromo / 100);
        $venda -> save();
        $vp -> delete();
    }

    /**
     * Verifica e retorna boolean para a existencia de objeto VendaProduto
     *
     * @param $venda
     * @param $produto
     * @return bool
     */
    public function verificaSeVendaProdutoExiste($venda, $produto)
    {
        foreach ($venda -> vendaProduto as $vp) {
            if ($vp -> codProduto == $produto -> codProduto) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verfica e retorna boolean caso exista Artido em ArtigoRamo
     *
     * @param $ramo
     * @param $produto
     * @return bool
     */
    public function verificaExisteArtigoEmArtigoRamo($ramo, $produto)
    {
        foreach ($ramo->artigos() as $ar){
            if ($ar -> codProduto == $produto -> codProduto) {
                return true;
            }
        }
        return false;
    }

    /**
     * Adiciona oobjeto Produto a objeto artigo Ramo
     *
     * @param $ramo
     * @param $produto
     * @param $qt
     */
    public function addArtigoRamo($ramo, $produto, $qt)
    {
        $ar = new ArtigoRamo();
        $ar -> ramo_id = $ramo -> codProduto;
        $ar -> codProduto = $produto -> codProduto;
        $ar -> descricao = $produto -> descricao;
        $ar -> preco_artigo_uni = $produto -> preco;
        $ar -> quantidade = $qt;

        $this->setPrecoEDescontoArtigoRamo($ar,$ramo,$produto,$qt);

        $ar -> save();
        $ramo -> save();
    }


    /**
     *Atribui valor a atributos Preço e Desconto a objeto Artigo Ramo
     *
     * @param $ar
     * @param $ramo
     * @param $produto
     * @param $qt
     */
    public function setPrecoEDescontoArtigoRamo($ar,$ramo,$produto,$qt)
    {
        if ($produto -> promocao && $produto->promocao->datainicio <= now() && $produto->promocao->datafim >= now()) {
            $ar -> percentagemPromo = $produto -> promocao -> percentagem;
            $ramo -> preco += ($produto -> preco * $qt * (1 - $produto -> promocao -> percentagem / 100));
        } else {
            $ramo -> preco += $produto -> preco * $qt;
            $ar -> percentagemPromo = 0;
        }
    }

    /**
     * Actualiza atributo quantidade em objeto ArtigoRamo
     *
     * @param $ramo
     * @param $produto
     * @param $qt
     */
    public function updateArtigoRamo($ramo, $produto, $qt)
    {
        foreach ($ramo->artigoRamo as $ar) {
            if ($ar -> codProduto == $produto -> codProduto) {
                $ar -> quantidade += $qt;

                $this->setPrecoEDescontoArtigoRamo($ar,$ramo,$produto,$qt);
            }
        }
        $ar -> update();
//        $produto -> update();
        $ramo -> update();
    }

    /**
     * Elimina objbeto ArtigoRamo e reajusta preço de objeto Ramo
     *
     * @param $ramo
     * @param $ar
     */
    public function eliminarArtigoRamo($ramo, $ar)
    {
        if ($ar -> percentagemPromo != 0)
        {
            $ramo -> preco -= $ar -> preco_artigo_uni * $ar -> quantidade * ($ar -> percentagemPromo / 100);
        }else{
            $ramo -> preco -= $ar -> quantidade * $ar -> preco_artigo_uni ;
        }
        $ramo -> save();
        $ar -> delete();

    }

    /**
     * Retorna clientes de acordo com o parametro
     *
     * @param $search
     * @return mixed
     */
    public function searchVenda($search)
    {
        return Venda::where('numContribuinte','like','%'.$search.'%')->orderBy('created_at', 'DESC')->paginate(10);
    }











}
