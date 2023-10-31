<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    //Adicionado no App Provider
    //protected $guarded = []; // libera a o massa assign de todos os campos.
    //protected $fillable = ['question']; // libera somente o item espessífico
}
