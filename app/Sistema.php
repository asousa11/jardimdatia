<?php

namespace App;


/**
 * Class Sistema
 * @package App
 */
class Sistema{

    /**
     * @var int
     */
    private $codProduto = 0 ;

    /**
     * @var GerirClientesHandler
     */
    private GerirClientesHandler $clienteHandler;

    /**
     * @var NewsletterHandler
     */
    private NewsletterHandler $newsletterHandler;

    /**
     * @var GerirProdutoHandler
     */
    private GerirProdutoHandler $produtoHandler;

    /**
     * @var CatalogClientes
     */
    private CatalogClientes $catalogClientes;

    /**
     * @var EpocaCatalog
     */
    private EpocaCatalog $catalogEpoca;

    /**
     * @var SugestaoCatalog
     */
    private SugestaoCatalog $sugestaoCatalog;

    /**
     * @var PromocaoCatalog
     */
    private PromocaoCatalog $promocaoCatalog;

    /**
     * @var CatalogVendas
     */
    private CatalogVendas $vendasCatalog;

    /**
     * @var CatalogProdutos
     */
    private CatalogProdutos $produtosCatalog;
    /**
     * @var GerirVendasHandler
     */
    private GerirVendasHandler $vendaHandler;

    /**
     * @var
     */
    private PremioHandler $premioHandler;

    /**
     * @var PremioCatalog
     */
    private PremioCatalog $premioCatalog;

    /**
     * Sistema constructor.
     */
    public function __construct()
    {
        $this->catalogClientes = new CatalogClientes();
        $this->catalogEpoca = new EpocaCatalog();
        $this->sugestaoCatalog = new SugestaoCatalog();
        $this->promocaoCatalog = new PromocaoCatalog();
        $this->vendasCatalog = new CatalogVendas();
        $this->produtosCatalog = new CatalogProdutos();
        $this->premioCatalog = new PremioCatalog();
        $this->clienteHandler = new GerirClientesHandler($this->catalogClientes);
        $this->newsletterHandler = new NewsletterHandler($this->catalogEpoca, $this->sugestaoCatalog, $this->promocaoCatalog);
        $this->vendaHandler = new GerirVendasHandler($this->vendasCatalog,$this->catalogClientes, $this->produtosCatalog);
        $this->produtoHandler = new GerirProdutoHandler($this->produtosCatalog);
        $this->premioHandler = new PremioHandler($this->premioCatalog);
    }

    /**
     * @return GerirClientesHandler
     */
    public function getClienteHandler()
    {
        return $this->clienteHandler;
    }

    /**
     * @return NewsletterHandler
     */
    public function getNewsletterHandler()
    {
        return $this->newsletterHandler;
    }

    public function getVendasHandler()
    {
        return $this->vendaHandler;
    }

    public function getProdutoHandler()
    {
        return $this->produtoHandler;
    }

    public function updateProductId()
    {
        $this->codProduto = $this->produtosCatalog->lastInsertedId();
    }

    public function getCodProduto()
    {
        return $this->codProduto;
    }

    public function setCodProduto($codProduto)
    {
        return $this->codProduto = $codProduto + 1;
    }

    public function getPremioHandler()
    {
        return $this->premioHandler;
    }

}
