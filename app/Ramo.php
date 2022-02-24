<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ramo
 * @package App
 */
class Ramo extends Produto
{
    protected $primaryKey = 'codProduto';

    /**
     * Relação ORM entre model Ramo e Promocao
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|mixed
     */
    public function promocao()
    {
        return $this->belongsTo(Promocao::class, 'promocao_id');
    }

    /**
     * Relação ORM entre model Ramo e Ocasiao
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ocasiao()
    {
        return $this->belongsTo(OcasiaoEspecial::class, 'ocasiao_id');
    }

    /**
     * Relação ORM entre model Flor,Extra,ProdutoManutencao,Ramo e Ramo
     *
     * @return \Illuminate\Support\Collection
     */
    public function artigos()
    {
        $types = [Flor::class, Extra::class, ProdutoManutencao::class, Ramo::class];
        $products = collect();

        foreach($types as $type) {
            $products_of_type = $this->belongsToMany($type,'artigo_ramos',
                'ramo_id',
                'codProduto')->getResults();

            foreach($products_of_type as $product) {
                $products->push($type::find($product['codProduto']));
            }
        }
        return $products;
    }

    /**
     * Relação ORM entre model Ramo e ArtigoRamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function artigoRamo()
    {
        return $this->hasMany(ArtigoRamo::class, 'ramo_id');
    }


}
