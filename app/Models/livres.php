<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livres extends Model
{
    use HasFactory;
    protected $fillable = ['isbn','titre','auteur_id','categ_id','emplacement_id','annee_publication','image_couverture','description','disponibilite'];

    public function categorie()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'categ_id');
    }
    public function emplacement()
    {
        return $this->belongsTo(\App\Models\emplacements::class, 'emplacement_id');
    }
    public function auteur()
    {
        return $this->belongsTo(\App\Models\auteurs::class, 'auteur_id');
    }
}
