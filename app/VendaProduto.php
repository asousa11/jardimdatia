<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{
    /**
     * Relação ORM entre model VendaProduto e Venda
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venda()
    {
        return $this->belongsTo(Venda::class, 'venda_id');
    }


}
