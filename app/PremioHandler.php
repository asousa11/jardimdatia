<?php


namespace App;


/**
 * Class PremioHandler
 * @package App
 */
class PremioHandler
{
    private PremioCatalog $premioCatalog;

    /**
     * PremioHandler constructor.
     * @param PremioCatalog $premioCatalog
     */
    public function __construct(PremioCatalog $premioCatalog)
    {
        $this->premioCatalog = $premioCatalog;
    }

    /**
     * Obtem e retorna objeto Premio
     *
     * @return mixed
     */
    public function getPremio()
    {
        return $this->premioCatalog->getPremio();
    }

    /**
     * Atualiza objeto Premio
     *
     * @param $volume
     * @param $premio
     */
    public function updatePremio($volume, $oferta)
    {
        $this->premioCatalog->updatePremio($volume, $oferta);
    }


}
