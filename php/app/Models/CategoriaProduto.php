<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    use HasFactory;

    protected $table = "tb_categoria_produto";

    protected $primaryKey = 'id_categoria_planejamento';

    public $timestamps = false;

    protected $fillable = ['nome_categoria'];

}
