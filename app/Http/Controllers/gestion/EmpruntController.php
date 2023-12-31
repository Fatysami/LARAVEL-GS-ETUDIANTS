<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Emprunt;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestion.gestion-listeLEmprunts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestion.gestion-ficheEmprunt');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'livre_id' => 'required|exists:livres,id',
            'emprunteur_id' => 'required|exists:categories,id',
            'date_emprunt' => 'required|date',
            'date_retour_prevue' => 'required|date',
            'date_retour_reelle' => 'nullable|date',
            'statut_emprunt' => 'required',
            'notes' => 'nullable',
        ]);
        $livre = Emprunt::create($validateData);
        return redirect('/gestion/gestion-listeLEmprunts')->with('success', 'Emprunt a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emprunt = Emprunt::findOrFail($id);
        return view('/gestion/gestion-ficheEmprunt', compact('emprunt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auteur = Emprunt::findOrFail($id);
        return view('/gestion/gestion-ficheAuteur', compact('Emprunt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $auteur = Emprunt::updateOrCreate(
            ['id' => $id], // conditions de recherche pour la mise à jour
            [
                'livre_id' => $request->livre_id,
                'emprunteur_id' => $request->emprunteur_id,
                'date_emprunt' => $request->date_emprunt,
                'date_retour_prevue' => $request->date_retour_prevue,
                'date_retour_reelle' => $request->date_retour_reelle,
                'statut_emprunt' => $request->statut_emprunt,
                'notes' => $request->notes,
            ] // attributs à mettre à jour ou à créer
        );
        return redirect('/gestion/gestion-listeLEmprunts')->with('success', 'Emprunt mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Emprunt = Emprunt::findOrFail($id);
        $Emprunt->delete();
        return redirect('/gestion/gestion-listeLEmprunts')->with('success', 'Emprunt supprimé avec succès');
    }

     /**
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function Search(Request $request)
  {
    $recherche = $request->input('recherche');

    // Si une variable de recherche est présente, effectuer la recherche en utilisant les clauses where()
    if (!empty($recherche)) {
    $Emprunt = Emprunt::whereHas('livre', function ($query) use ($recherche) {
        $query->where('titre', 'LIKE', '%' . $recherche . '%');
    })
    ->orWhereHas('emprunteur', function ($query) use ($recherche) {
        $query->where('nom', 'LIKE', '%' . $recherche . '%');
    })
    ->orWhere('date_emprunt', 'LIKE', '%' . $recherche . '%')
    ->get();
}
    // Sinon, récupérer tous les utilisateurs sans condition de recherche
    else {
        $emprunt = Emprunt::all();
    }

    return view('/gestion/gestion-listeLEmprunts', compact('emprunt'));

  }
}

