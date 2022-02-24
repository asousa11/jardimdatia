<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Flor
 * @package App
 */
class Flor extends Produto
{
    protected $primaryKey = 'codProduto';

    /**
     * Relação ORM entre model Flor e Promocao
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|mixed
     */
    public function promocao()
    {
        return $this->belongsTo(Promocao::class, 'promocao_id');
    }

    /**
     * Relação ORM entre model Flor e Epoca
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function epoca()
    {
        return $this->belongsTo(Epoca::class);
    }
}
