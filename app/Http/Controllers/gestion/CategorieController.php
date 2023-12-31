<?php

namespace App\Http\Controllers\gestion;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestion.gestion-listeCategories');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestion.gestion-ficheCategorie');
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
       'nom_categorie'=>'required|max:500',
       'statut_categorie'=>'required|max:50',
       'description'=>'required',
        ]);
        
        $Categories=Categories::create($validateData);
        return redirect('/gestion/gestion-listeCategories')->with('success', 'Catégorie a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie = Categories::findOrFail($id);
        return view('/gestion/gestion-ficheCategorie', compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Categories::findOrFail($id);
        return view('/gestion/gestion-ficheCategorie', compact('categorie'));
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
        $categorie = Categories::updateOrCreate(
            ['id' => $id], // conditions de recherche pour la mise à jour
            [
                'nom_categorie' => $request->nom_categorie,
                'statut_categorie' => $request->statut_categorie,
                'description' => $request->description
            ] // attributs à mettre à jour ou à créer
        );
        
        return redirect('/gestion/gestion-listeCategories')->with('success', 'Catégorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Categ = Categories::findOrFail($id);
        $Categ->delete();
        return redirect('/gestion/gestion-listeCategories')->with('success', 'Catégorie supprimée avec succès');
    }

    /**
   * Desactiver the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function Search(Request $request)
  {
    $recherche = $request->input('recherche');

    // Si une variable de recherche est présente, effectuer la recherche en utilisant les clauses where()
    if (!empty($recherche)) {
        $categories = Categories::where('nom_categorie', 'LIKE', '%' . $recherche . '%')
            ->orWhere('description', 'LIKE', '%' . $recherche . '%')
            ->get();
    } 
    // Sinon, récupérer tous les utilisateurs sans condition de recherche
    else {
        $categories = Categories::all();
    }
    return view('/gestion/gestion-listeCategories', compact('categories'));

  }
}
