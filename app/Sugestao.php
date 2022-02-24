<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sugestao
 * @package App
 */
class Sugestao extends Model
{
    /**
     * Relação ORM entre model Sugestao e Epoca
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function epoca()
    {
        return $this->belongsTo(Epoca::class);
    }
}
