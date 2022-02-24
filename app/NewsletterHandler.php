<?php


namespace App;


use Illuminate\Database\Eloquent\Collection;

/**
 * Class NewsletterHandler
 * @package App
 */
class NewsletterHandler
{
    private EpocaCatalog $catalogEpoca;

    private SugestaoCatalog $sugestaoCatalog;

    private PromocaoCatalog $promocaoCatalog;

    /**
     * ClienteHandler constructor.
     * @param EpocaCatalog $catalogEpoca
     * @param SugestaoCatalog $sugestaoCatalog
     * @param PromocaoCatalog $promocaoCatalog
     */
    public function __construct(EpocaCatalog $catalogEpoca, SugestaoCatalog $sugestaoCatalog, PromocaoCatalog $promocaoCatalog)
    {
        $this->catalogEpoca = $catalogEpoca;
        $this->sugestaoCatalog = $sugestaoCatalog;
        $this->promocaoCatalog = $promocaoCatalog;
    }

    /**
     * Retorna a Epoca corrente
     *
     * @return Epoca|mixed
     */
    public function getCurrentEpoca()
    {
        return $this->catalogEpoca->getCurrentEpoca();
    }

    /**
     * Obtem e retorna Promocoes Ativas
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCurrentPromocoes()
    {
        return $this->promocaoCatalog->getCurrentPromocoes();
    }


}
