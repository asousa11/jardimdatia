<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epoca extends Model
{
    /**
     * Relação ORM entre model Epoca e Sugestoes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sugestoes()
    {
        return $this->hasMany(Sugestao::class);
    }

    /**
     * Relação ORM entre model Epoca e Flores
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flores()
    {
        return $this->hasMany(Flor::class);
    }
}
