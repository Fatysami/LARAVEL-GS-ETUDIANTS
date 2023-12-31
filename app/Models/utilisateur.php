<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class utilisateur extends Model
{
    use HasFactory;
    protected $fillable = ['type_membre','nom','email','password','telephone','adresse','ville','pays','code_postal','statut'];
}
