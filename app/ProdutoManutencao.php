<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProdutoManutencao
 * @package App
 */
class ProdutoManutencao extends Produto
{
    protected $primaryKey = 'codProduto';

    /**
     * Relação ORM entre model ProdutoManutencao e Promocao
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|mixed
     */
    public function promocao()
    {
        return $this->belongsTo(Promocao::class, 'promocao_id');
    }
}
