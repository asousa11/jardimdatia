<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class OcasiaoEspecial
 * @package App
 */
class OcasiaoEspecial extends Model
{

    /**
     * Relação ORM entre model OcasiaoEspeciak e Ramo
     *
     * @return HasMany
     */
    public function ramos()
    {
        return $this->hasMany(Ramo::class);
    }
}
