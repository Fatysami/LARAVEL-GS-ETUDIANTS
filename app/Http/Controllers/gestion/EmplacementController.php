<?php

namespace App\Http\Controllers\gestion;

use App\Http\Controllers\Controller;
use App\Models\emplacements;
use Illuminate\Http\Request;

class EmplacementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestion.gestion-listeEmplacements');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestion.gestion-ficheEmplacement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'rayon'=>'required|max:500',
            'numero_etagere'=>'required',
             ]);
             
             $Emplacement=emplacements::create($validateData);
             return redirect('/gestion/gestion-listeEmplacements')->with('success', 'Emplacement a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emplacement = emplacements::findOrFail($id);
        return view('/gestion/gestion-ficheEmplacement', compact('emplacement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emplacement = emplacements::findOrFail($id);
        return view('/gestion/gestion-ficheEmplacement', compact('emplacement'));
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
        $emplacements = emplacements::updateOrCreate(
            ['id' => $id], // conditions de recherche pour la mise à jour
            [
                'rayon' => $request->rayon,
                'numero_etagere' => $request->numero_etagere,
            ] // attributs à mettre à jour ou à créer
        );
        
        return redirect('/gestion/gestion-listeEmplacements')->with('success', 'Emplacement mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emplacement = emplacements::findOrFail($id);
        $emplacement->delete();
        return redirect('/gestion/gestion-listeEmplacements')->with('success', 'Emplacement supprimé avec succès');
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
        $emplacements = emplacements::where('rayon', 'LIKE', '%' . $recherche . '%')
            ->orWhere('numero_etagere', 'LIKE', '%' . $recherche . '%')
            ->get();
    } 
    // Sinon, récupérer tous les utilisateurs sans condition de recherche
    else {
        $emplacements = emplacements::all();
    }

    return view('/gestion/gestion-listeEmplacements', compact('emplacements'));

  }
}
