<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartaoCliente
 * @package App
 */
class CartaoCliente extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'numCartao';

    /**
     * Relação ORM entre model CartaoCliente e Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'numContribuinte');
    }
}
