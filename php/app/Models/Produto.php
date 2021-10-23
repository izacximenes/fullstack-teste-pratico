<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    const CREATED_AT = 'data_cadastro';

    const UPDATED_AT = null;

    protected $table = "tb_produto";

    protected $primaryKey = 'id_produto';

    public $timestamps = ['created_at'];

    public $fillable = ['id_categoria_planejamento', 'nome_produto', 'valor_produto'];

    public function categoria()
    {
        return $this->hasOne(CategoriaProduto::class, 'id_categoria_planejamento', 'id_categoria_planejamento');
    }
}
