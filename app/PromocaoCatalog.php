<?php


namespace App;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class PromocaoCatalog
 * @package App
 */
class PromocaoCatalog
{
    /**
     * Obtem e retorna a coleção de Promocoes existe na data atual
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCurrentPromocoes()
    {
        return Promocao::where([
            ['datainicio', '<', now()],
            ['datafim', '>', now()],
        ])->get();
    }

}
