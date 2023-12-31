<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auteurs extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prenom','nationalite','date_naissance','date_deces','biographie'];
}
