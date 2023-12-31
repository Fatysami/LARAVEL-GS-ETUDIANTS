@extends('layouts/contentNavbarLayout')

@section('title', 'Paramétrage - Auteurs')

@section('content')
@if(!request()->has('recherche'))
    @php
    $auteurs = App\Models\auteurs::all(); // récupérer tous les auteurs depuis la base de données 
    @endphp
@endif
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Paramétrage /</span> Liste des auteurs
</h4>
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Actions</h5>
    <!-- Search -->
    <form action="{{ route('gestion-listeAuteurs.Search') }}" method="POST" class="navbar-nav align-items-center">
        @csrf
        <div class="nav-item d-flex align-items-center me-3">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="recherche" class="form-control border-0 shadow-none" placeholder="Recherche..." aria-label="Recherche...">
            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
            <a href="{{ route('gestion-listeAuteurs.index') }}" class="btn btn-secondary ms-2">Actualiser</a>
        </div>
    </form>
    <!-- /Search -->
    <a href="{{ route('gestion-listeAuteurs.create') }}" class="btn btn-primary">Ajouter un auteur</a>
  </div>
</div>
<div class="card">
  <h5 class="card-header">Liste des auteurs</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Nationalité</th>
          <th>Date de naissance</th>
          <th>Date de décès</th>
          <th>Profession</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($auteurs as $auteur)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$auteur->nom}}</strong></td>
          <td>{{$auteur->prenom}}</td>
          <td>{{$auteur->nationalite}}</td>
          <td>{{$auteur->date_naissance}}</td>
          <td>{{$auteur->date_deces}}</td>
          <td>{{$auteur->profession}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <form method="POST" align="left">
                  <a class="dropdown-item" href="{{ route('gestion-listeAuteurs.show' , $auteur->id) }}"><i class="bx bx-show me-1"></i> Afficher</a>
                  </form>
                  <form method="POST" align="left">
                    <a class="dropdown-item" href="{{ route('gestion-listeAuteurs.update' , $auteur->id) }}"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                    </form>
                    <form action="{{ route('gestion-listeAuteurs.destroy', $auteur->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet auteur ?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Supprimer</button>
                  </form>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<hr class="my-5">
@endsection