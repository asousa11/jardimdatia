<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Relação ORM entre model Ramo e Artigo Ramo
 *
 * Class ArtigoRamo
 * @package App
 *
 */
class ArtigoRamo extends Model
{
    public function ramo()
    {
        return $this->belongsTo(Ramo::class, 'ramo_id');
    }

}
