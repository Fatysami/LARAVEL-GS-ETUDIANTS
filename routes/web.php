<?php
namespace App\Http\Controllers\gestion;

use Illuminate\Support\Facades\Route;


$controller_path = 'App\Http\Controllers';

// Main Page Route

Route::get('/', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/dashboard', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');


//Mes pages de projets 
route::resource('/gestion/gestion-listeCategories',CategorieController::class);
route::resource('/gestion/gestion-listeEmplacements',EmplacementController::class);
route::resource('/gestion/gestion-listeAuteurs',AuteurController::class);
route::resource('/gestion/gestion-listeLivres',LivreController::class);
route::resource('/gestion/gestion-listeUtilisateurs',UtilisateurController::class);
route::resource('/gestion/gestion-listeLEmprunts',EmpruntController::class);
route::resource('/utilisateur',UtilisateurController::class);

Route::post('/gestion/gestion-enregistrerUtilisateur', [App\Http\Controllers\gestion\UtilisateurController::class, 'store'])->name('enregistrerUtilisateur');
Route::post('/gestion-listeUtilisateurs/search', [UtilisateurController::class, 'Search'])->name('gestion-listeUtilisateurs.Search');
Route::post('/gestion-listeCategories/search', [CategorieController::class, 'Search'])->name('gestion-listeCategories.Search');
Route::post('/gestion-listeAuteurs/search', [AuteurController::class, 'Search'])->name('gestion-listeAuteurs.Search');
Route::post('/gestion-listeEmplacements/search', [EmplacementController::class, 'Search'])->name('gestion-listeEmplacements.Search');
Route::post('/gestion-listeLivres/search', [LivreController::class, 'Search'])->name('gestion-listeLivres.Search');
Route::post('/gestion-listeLivres/searchcarte', [LivreController::class, 'SearchCarte'])->name('gestion-listeLivres.SearchCarte');
Route::post('/gestion-listeLEmprunts/search', [EmpruntController::class, 'Search'])->name('gestion-listeLEmprunts.Search');

Route::get('/gestion/gestion-listeUtilisateurs/desactiver/{id}',[UtilisateurController::class, 'Desactiver'])->name('gestion-listeUtilisateurs.Desactiver');
Route::get('/gestion/gestion-paramCompte/{id?}', [UtilisateurController::class, 'show'])->name('utilisateur.show');
Route::get('/login', [UtilisateurController::class, 'login'])->name('utilisateur.login');
Route::get('/gestion-listeLivres/cartes',[LivreController::class, 'VueCartes'])->name('gestion-listeLivres.VueCartes');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');
