<?php

namespace App\Http\Controllers\gestion;
use App\Models\utilisateur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        return view('gestion.gestion-listeUtilisateurs');
    }

    public function login(Request $request)
    {
     // Récupérer l'e-mail et le mot de passe de l'utilisateur
     $email = $request->input('email');
     $password = $request->input('password');
     // Vérifier si l'utilisateur existe dans laz base de données
     //dd($password);
     $user = utilisateur::where('email', $email)->first();
     //dd( $user);
     if (!$user || !Hash::check($password, $user->password)) {
         // Si l'utilisateur n'existe pas ou si le mot de passe est incorrect
         return back()->withErrors([
             'email' => 'Adresse e-mail ou mot de passe incorrect',
         ]);
     }
     // Stocker l'ID de l'utilisateur dans la session
     session()->put('user_id', $user->id);
     session()->put('user_nom', $user->nom);
     session()->put('user_type', $user->type_membre);
     
     return view('content.dashboard.dashboards-analytics');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pays = ['Maroc', 'Canada', 'China', 'France', 'Germany', 'Italy', 'Japan', 'Russia', 'United Arab Emirates', 'United States'];
        return view('/gestion/gestion-paramCompte', compact('pays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_membre' => 'required',
            'nom' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $User = utilisateur::create($validatedData);
        return redirect('auth/login-basic')->with('success', 'Utilisateur enregistré avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        if(!$id) {
            $id= session()->get('user_id');
        }
        $utilisateur = utilisateur::findOrFail($id);
        $pays = ['Maroc', 'Canada', 'China', 'France', 'Germany', 'Italy', 'Japan', 'Russia', 'United Arab Emirates', 'United States'];
        return view('/gestion/gestion-paramCompte', compact('utilisateur','pays'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $utilisateur = utilisateur::updateOrCreate(
            ['id' => $id], // conditions de recherche pour la mise à jour
            [
                'type_membre' => $request->type_membre,
                'nom' => $request->nom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
                'ville' => $request->ville,
                'pays' => $request->pays,
                'code_postal' => $request->code_postal,
                'photo' => $request->photo,
            ] // attributs à mettre à jour ou à créer
        );
        
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $destinationPath = public_path('images');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $utilisateur->photo = $profileImage;
            $utilisateur->save();
        } 
    
        return redirect('/gestion/gestion-listeUtilisateurs')->with('success', 'Utilisateur mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = utilisateur::findOrFail($id);
        $user->delete();
        return redirect('/gestion/gestion-listeUtilisateurs')->with('success', 'Utilisateur supprimé avec succès');
    }


/**
    * Desactiver the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function Desactiver($id)
   {
       $user = utilisateur::findOrFail($id);
       $user->update(['statut' => 'Inactif']);
       return redirect('/gestion/gestion-listeUtilisateurs')->with('success', 'Utilisateur désactivé avec succès');

   }
/**
   * Desactiver the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function GetMenu($id)
  {
      $user = utilisateur::findOrFail($id);
      $user->update(['statut' => 'Inactif']);
      return redirect('/gestion/gestion-listeUtilisateurs')->with('success', 'Utilisateur désactivé avec succès');

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
        $utilisateurs = Utilisateur::where('nom', 'LIKE', '%' . $recherche . '%')
            ->orWhere('email', 'LIKE', '%' . $recherche . '%')
            ->get();
    } 
    // Sinon, récupérer tous les utilisateurs sans condition de recherche
    else {
        $utilisateurs = Utilisateur::all();
    }

    return view('/gestion/gestion-listeUtilisateurs', compact('utilisateurs'));

  }

  public function logout()
{
    Utilisateur::logout();
    return redirect()->route('auth-login-basic');
}
}
