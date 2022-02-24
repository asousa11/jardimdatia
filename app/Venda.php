<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    /**
     * Relação ORM entre model Venda e Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'numContribuinte');
    }

    /**
     * Relação ORM entre model Flor,Extra,ProdutoManutencao,Ramo e Venda
     *
     * @return \Illuminate\Support\Collection
     */
    public function produtos()
    {
        $types = [Flor::class, Extra::class, ProdutoManutencao::class, Ramo::class];
        $products = collect();

        foreach($types as $type) {
            $products_of_type = $this->belongsToMany($type,'venda_produtos',
                'venda_id',
                'codProduto')->getResults();

            foreach($products_of_type as $product) {
                $products->push($type::find($product['codProduto']));
            }
        }
        return $products;
    }

    /**
     * Relação ORM entre model VendaProduto e Venda
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendaProduto()
    {
        return $this->hasMany(VendaProduto::class, 'venda_id');
    }

    /**
     * Relação ORM entre model Venda e Premio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function premio()
    {
        return $this->belongsTo(Premio::class);
    }
}
