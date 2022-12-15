<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'telefones';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'tipoTelefoneRelationship',
        'created_at',
        'updated_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'tipoTelefone'
    ];

    /**
     * Get the TipoTelefone attribute.
     *
     * @return string
     */
    public function getTipoTelefoneAttribute() {
        return $this->tipoTelefoneRelationship;
    }

    /**
     * Get the TipoTelefone that owns the telefone.
     *
     * @return TipoTelefone
     */
    public function tipoTelefoneRelationship()
    {
        return $this->belongsTo(TipoTelefone::class,'tipo_telefone_id');
    }

}
