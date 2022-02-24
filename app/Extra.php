<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Extra
 * @package App
 */
class Extra extends Produto
{
    protected $primaryKey = 'codProduto';

    /**
     * Relação ORM entre model Extra e Promocao
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|mixed
     */
    public function promocao()
    {
        return $this->belongsTo(Promocao::class, 'promocao_id');
    }

    /**
     * Relação ORM entre model Extra e ArtigoRamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function artigoRamo()
    {
        return $this->hasMany(ArtigoRamo::class, 'codProduto');
    }

    public function getRouteKeyName()
    {
        return 'codProduto';
    }



}
