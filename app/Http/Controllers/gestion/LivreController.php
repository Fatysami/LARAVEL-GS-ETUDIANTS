<?php

namespace App\Http\Controllers\gestion;
use App\Models\livres;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestion.gestion-listeLivres');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestion.gestion-ficheLivre');
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
        'isbn' => 'required|unique:livres',
        'titre' => 'required',
        'auteur_id' => 'required|exists:auteurs,id',
        'categ_id' => 'required|exists:categories,id',
        'emplacement_id' => 'required|exists:emplacements,id',
        'annee_publication' => 'required|integer|min:0',
        'image_couverture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'nullable',
        'disponibilite' => 'integer|min:0|max:5',
    ]);

    if ($request->hasFile('image_couverture')) {

        if ($image = $request->file('image_couverture')) {
            $destinationPath = public_path('images');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $validateData['image_couverture'] = $profileImage;
            }
    } 
    $livre = livres::create($validateData);
    return redirect('/gestion/gestion-listeLivres')->with('success', 'Le livre a été créé avec succès.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livre = livres::findOrFail($id);
        return view('/gestion/gestion-ficheLivre', compact('livre'));
    }

    public function VueCartes()
    {
        return view('gestion.gestion-listeLivresCartes');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livre = livres::findOrFail($id);
        return view('/gestion/gestion-ficheLivre', compact('livre'));
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
    $livre = Livres::updateOrCreate(
        ['id' => $id], // conditions de recherche pour la mise à jour
        [
            'isbn' => $request->isbn,
            'titre' => $request->titre,
            'auteur_id' => $request->auteur_id,
            'categ_id' => $request->categ_id,
            'emplacement_id' => $request->emplacement_id,
            'annee_publication' => $request->annee_publication,
            'description' => $request->description,
            'disponibilite' => $request->disponibilite,
            'image_couverture' => $request->image_couverture,
        ] // attributs à mettre à jour ou à créer
    );
    
    if ($request->hasFile('image_couverture')) {
        $image = $request->file('image_couverture');
        $destinationPath = public_path('images');
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $livre->image_couverture = $profileImage;
        $livre->save();
    } 

    return redirect('/gestion/gestion-listeLivres')->with('success', 'Livre mise à jour avec succès');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livre = livres::findOrFail($id);
        $livre->delete();
        return redirect('/gestion/gestion-listeLivres')->with('success', 'Livre supprimé avec succès');
        
        
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
        $livres = livres::where('isbn', 'LIKE', '%' . $recherche . '%')
            ->orWhere('titre', 'LIKE', '%' . $recherche . '%')
            ->orWhere('description', 'LIKE', '%' . $recherche . '%')
            ->get();
    } 
    // Sinon, récupérer tous les utilisateurs sans condition de recherche
    else {
        $livres = livres::all();
    }

    return view('/gestion/gestion-listeLivres', compact('livres'));

  }

     /**
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function SearchCarte(Request $request)
  {
    $recherche = $request->input('recherche');

    // Si une variable de recherche est présente, effectuer la recherche en utilisant les clauses where()
    if (!empty($recherche)) {
        $livres = livres::where('isbn', 'LIKE', '%' . $recherche . '%')
            ->orWhere('titre', 'LIKE', '%' . $recherche . '%')
            ->orWhere('description', 'LIKE', '%' . $recherche . '%')
            ->get();
    } 
    // Sinon, récupérer tous les utilisateurs sans condition de recherche
    else {
        $livres = livres::all();
    }

    return view('/gestion/gestion-listeLivresCartes', compact('livres'));

  }
}
