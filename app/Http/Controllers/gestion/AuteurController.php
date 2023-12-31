<?php

namespace App\Http\Controllers\gestion;
use App\Models\auteurs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //Je récupère les nationalités
   
    public function index()
    {
        return view('gestion.gestion-listeAuteurs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationalites = include resource_path('Lang\nationalites.php');
        return view('gestion.gestion-ficheAuteur',compact('nationalites'));
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
            'nom'=>'required',
            'prenom'=>'required',
            'nationalite'=>'required',
            'date_naissance'=>'required|date',
            'date_deces'=>'required|date',
            'biographie'=>'required|max:500',
             ]);
             
             $auteur=auteurs::create($validateData);
             return redirect('/gestion/gestion-listeAuteurs')->with('success', 'Auteur a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nationalites = include resource_path('Lang/nationalites.php');
        $auteur = auteurs::findOrFail($id);
        return view('/gestion/gestion-ficheAuteur', compact('auteur', 'nationalites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nationalites = include resource_path('Lang/nationalites.php');
        $auteur = auteurs::findOrFail($id);
        return view('/gestion/gestion-ficheAuteur', compact('auteur', 'nationalites'));
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
            $auteur = auteurs::updateOrCreate(
            ['id' => $id], // conditions de recherche pour la mise à jour
            [
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'nationalite' => $request->nationalite,
                'date_naissance' => $request->date_naissance,
                'date_deces' => $request->date_deces,
                'biographie' => $request->biographie,
            ] // attributs à mettre à jour ou à créer
        );
        
        return redirect('/gestion/gestion-listeAuteurs')->with('success', 'Auteur mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auteur = auteurs::findOrFail($id);
        $auteur->delete();
        return redirect('/gestion/gestion-listeAuteurs')->with('success', 'Emplacement supprimé avec succès');
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
        $auteurs = auteurs::where('nom', 'LIKE', '%' . $recherche . '%')
            ->orWhere('prenom', 'LIKE', '%' . $recherche . '%')
            ->get();
    } 
    // Sinon, récupérer tous les utilisateurs sans condition de recherche
    else {
        $auteurs = auteurs::all();
    }

    return view('/gestion/gestion-listeAuteurs', compact('auteurs'));

  }
}
