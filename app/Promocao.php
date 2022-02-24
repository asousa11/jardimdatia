<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Promocao
 * @package App
 */
class Promocao extends Model
{
    /**
     * Relação ORM entre model Extra,Flor,ProdutoManutencao,Ramo e Promocao
     *
     * @return \Illuminate\Support\Collection
     */
    public function produtos()
    {
        $types = [Flor::class, Extra::class, ProdutoManutencao::class, Ramo::class];
        $products = collect();

        foreach($types as $type) {
            $products_of_type = $this->hasMany($type)->getResults();

            foreach($products_of_type as $product) {
                $products->push($type::find($product['codProduto']));
            }
        }
        return $products;
    }
}
