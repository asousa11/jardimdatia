<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    /**
     * Relação ORM entre model Prémio e Venda
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function venda()
    {
        return $this->hasMany(Venda::class);
    }
}
