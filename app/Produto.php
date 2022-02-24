<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Produto
 * @package App
 */
abstract class Produto extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'codProduto';

    /**
     * Método abstrato para relação ORM entre objetos Produto e Promocao
     *
     * @return mixed
     */
    abstract public function promocao();
}
