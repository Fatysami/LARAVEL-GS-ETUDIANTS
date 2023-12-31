@extends('layouts/contentNavbarLayout')

@section('title', 'Paramétrage - Liste utilisateurs')

@section('content')
@if(!request()->has('recherche'))
    @php
        $utilisateurs = App\Models\utilisateur::all();
    @endphp
@endif

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Paramétrage /</span> Liste des utilisateurs
</h4>
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Actions</h5>
    <!-- Search -->
    <form action="{{ route('gestion-listeUtilisateurs.Search') }}" method="POST" class="navbar-nav align-items-center">
        @csrf
        <div class="nav-item d-flex align-items-center me-3">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="recherche" class="form-control border-0 shadow-none" placeholder="Recherche..." aria-label="Recherche...">
            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
            <a href="{{ route('gestion-listeUtilisateurs.index') }}" class="btn btn-secondary ms-2">Actualiser</a>
        </div>
    </form>
    <!-- /Search -->
  </div>
</div>
<div class="card">
  <h5 class="card-header">Liste des utilisateurs</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>nom</th>
          <th>email</th>
          <th>Statut adhésion</th>
          <th>Etat</th>
          <th>Photo</th>
          <th>Téléphone</th>
          <th>Adresse</th>
          <th>Ville</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($utilisateurs as $utilisateur)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$utilisateur->nom}}</strong></td>
          <td>{{$utilisateur->email}}</td>
          <td>{{$utilisateur->type_membre}}</td>
          @if ($utilisateur->statut == 'Actif')
          <td><span class="badge bg-label-info me-1">{{$utilisateur->statut }}</td>
          @else
         <td><span class="badge bg-label-warning me-1">{{$utilisateur->statut }}</td>
          @endif
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title={{$utilisateur->nom}}>
                @if ($utilisateur->	photo)
                <img src="{{ asset('images/' . $utilisateur->	photo) }}" alt="avatar" class="rounded-circle">
               @else
                <img src="{{ asset('images/avatar.png') }}" alt="Avatar par défaut" class="rounded-circle">
                @endif
              </li>
            </ul>
          </td>
          <td>{{$utilisateur->telephone}}</td>
          <td>{{$utilisateur->adresse}}</td>
          <td>{{$utilisateur->ville}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <form method="POST" align="left">
                  <a class="dropdown-item" href="{{ route('gestion-listeUtilisateurs.show' , $utilisateur->id) }}"><i class="bx bx-show me-1"></i> Afficher</a>
                  </form>
                  <form method="POST" align="left">
                    <a class="dropdown-item" href="{{ route('gestion-listeUtilisateurs.update' , $utilisateur->id) }}"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                    </form>
                    <form action="{{ route('gestion-listeUtilisateurs.destroy', $utilisateur->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet auteur ?')">
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