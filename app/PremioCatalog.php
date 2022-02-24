<?php


namespace App;


/**
 * Class PremioCatalog
 * @package App
 */
class PremioCatalog
{

    /**
     * Obtem e retorn o primeiro objeto a ser inserido
     *
     * @return mixed
     */
    public function getPremio()
    {
        return Premio::all()->first();
    }

    /**
     * Actualiza objeto Premio, e persiste-o
     *
     * @param $volume
     * @param $premio
     */
    public function updatePremio($volume, $oferta)
    {
        $premio = $this->getPremio();
        $premio->volumeNegocio = $volume;
        $premio->oferta = $oferta;
        $premio->save();
    }
}
