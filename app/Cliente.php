<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class cliente
 * @package App
 */
class Cliente extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'numContribuinte';

    /**
     * Relação ORM entre model CartaoCliente e Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cartao()
    {
        return $this->hasOne(CartaoCliente::class,'numContribuinte');
    }

    /**
     * Relação ORM entre model Vendas e Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendas()
    {
        return $this->hasMany(Venda::class,'numContribuinte');
    }

    public function getRouteKeyName()
    {
        return 'numContribuinte';
    }
}
