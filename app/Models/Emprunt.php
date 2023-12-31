<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    use HasFactory;
    protected $fillable = ['livre_id','emprunteur_id','date_emprunt','date_retour_prevue','date_retour_reelle','statut_emprunt','notes'];
    public function livre()
    {
        return $this->belongsTo('App\Models\livres');
    }
    public function emprunteur()
    {
        return $this->belongsTo('App\Models\utilisateur');
    }
}
