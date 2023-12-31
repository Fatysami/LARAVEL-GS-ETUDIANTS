@extends('layouts/contentNavbarLayout')

@section('title', 'Paramétrage - Catégorie')
@section('content')

@if(!request()->has('recherche'))
    @php
        $categories = App\Models\Categories::all();
    @endphp
@endif

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Paramétrage /</span> Liste des catégories des catégories
</h4>
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Actions</h5>
    <!-- Search -->
    <form action="{{ route('gestion-listeCategories.Search') }}" method="POST" class="navbar-nav align-items-center">
        @csrf
        <div class="nav-item d-flex align-items-center me-3">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="recherche" class="form-control border-0 shadow-none" placeholder="Recherche..." aria-label="Recherche...">
            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
            <a href="{{ route('gestion-listeCategories.index') }}" class="btn btn-secondary ms-2">Actualiser</a>
        </div>
    </form>
    <!-- /Search -->
    <a href="{{ route('gestion-listeCategories.create') }}" class="btn btn-primary">Ajouter une catégorie</a>
  </div>
</div>
<div class="card">
  <h5 class="card-header">Liste des catégories</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Catégorie</th>
          <th>Date de création</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($categories as $categorie)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$categorie->nom_categorie}}</strong></td>
          <td>{{$categorie->created_at}}</td>
          @if ($categorie->statut_categorie == 'Active')
          <td><span class="badge bg-label-info me-1">{{$categorie->statut_categorie}}</td>
        @else
        <td><span class="badge bg-label-warning me-1">{{$categorie->statut_categorie}}</td>
        @endif
          
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <form method="POST" align="left">
                  <a class="dropdown-item" href="{{ route('gestion-listeCategories.show' , $categorie->id) }}"><i class="bx bx-show me-1"></i> Afficher</a>
                  </form>
                  <form method="POST" align="left">
                    <a class="dropdown-item" href="{{ route('gestion-listeCategories.update' , $categorie->id) }}"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                    </form>
                <form action="{{ route('gestion-listeCategories.destroy', $categorie->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
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