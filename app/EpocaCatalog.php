<?php


namespace App;


use Carbon\Carbon;

/**
 * Class EpocaCatalog
 * @package App
 */
class EpocaCatalog
{

    /**
     * Retorna o objeto Epoca que decorre à data de hoje
     *
     * @return Epoca|mixed
     */
    public function getCurrentEpoca()
    {
        foreach (Epoca::all() as $epoca){
            if (now() > $epoca->datainicio and now() < $epoca->datafim)
                return $epoca;
        }
    }
}
