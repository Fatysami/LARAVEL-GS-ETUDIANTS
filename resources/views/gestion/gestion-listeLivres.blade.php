@extends('layouts/contentNavbarLayout')

@section('title', 'Paramétrage - Livres')

@section('content')
@if(!request()->has('recherche'))
    @php
    $livres = App\Models\livres::all(); // récupérer tous les auteurs depuis la base de données
    @endphp
@endif
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Paramétrage /</span> Liste des livres
</h4>
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Actions</h5>
    <!-- Search -->
    <form action="{{ route('gestion-listeLivres.Search') }}" method="POST" class="navbar-nav align-items-center">
        @csrf
        <div class="nav-item d-flex align-items-center me-3">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="recherche" class="form-control border-0 shadow-none" placeholder="Recherche..." aria-label="Recherche...">
            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
            <a href="{{ route('gestion-listeLivres.index') }}" class="btn btn-secondary ms-2">Actualiser</a>
        </div>
    </form>
    <!-- /Search -->
    <a href="{{ route('gestion-listeLivres.create') }}" class="btn btn-primary">Ajouter un livre</a>
  </div>
</div>
<div class="card">
  <h5 class="card-header">Liste des livres</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Titre</th>
          <th>isbn</th>
          <th>Auteur</th>
          <th>Catégorie</th>
          <th>Emplacement</th>
          <th>Année de publication</th>
          <th>Couverture</th>
          <th>Disponibilité</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($livres as $livre)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$livre->titre}}</strong></td>
          <td>{{$livre->isbn}}</td>
          <td>{{$livre->auteur ?  $livre->auteur->nom . ' ' . $livre->auteur->prenom : '' }}</td>
          <td>{{$livre->categorie ? $livre->categorie->nom_categorie : '' }}</td>
          <td>{{$livre->emplacement ? $livre->emplacement->rayon : '' }} </td>
          <td>{{$livre->annee_publication}}</td>
          <td>
          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title={{$livre->titre}}>
              @if ($livre->image_couverture)
              <img src="{{ asset('images/' . $livre->image_couverture) }}" alt="Couverture" class="rounded-circle">
             @else
              <img src="{{ asset('images/placeholder.jpg') }}" alt="Couverture par défaut" class="rounded-circle">
              @endif
            </li>
          </ul>
        </td>
        <td>{{$livre->disponibilite}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <form method="POST" align="left">
                  <a class="dropdown-item" href="{{ route('gestion-listeLivres.show' , $livre->id) }}"><i class="bx bx-show me-1"></i> Afficher</a>
                  </form>
                  <form method="POST" align="left">
                    <a class="dropdown-item" href="{{ route('gestion-listeLivres.update' , $livre->id) }}"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                    </form>
                    <form action="{{ route('gestion-listeLivres.destroy', $livre->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet auteur ?')">
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