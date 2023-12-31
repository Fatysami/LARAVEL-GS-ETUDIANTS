@extends('layouts/contentNavbarLayout')

@section('title', 'Paramétrage - Emplacements')

@section('content')

@if(!request()->has('recherche'))
    @php
       $emplacements = App\Models\emplacements::all(); // récupérer toutes les emplacements depuis la base de données 
    @endphp
@endif
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Paramétrage /</span> Liste des emplacements des livres
</h4>
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Actions</h5>
    <!-- Search -->
    <form action="{{ route('gestion-listeEmplacements.Search') }}" method="POST" class="navbar-nav align-items-center">
        @csrf
        <div class="nav-item d-flex align-items-center me-3">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="recherche" class="form-control border-0 shadow-none" placeholder="Recherche..." aria-label="Recherche...">
            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
            <a href="{{ route('gestion-listeEmplacements.index') }}" class="btn btn-secondary ms-2">Actualiser</a>
        </div>
    </form>
    <!-- /Search -->
    <a href="{{ route('gestion-listeEmplacements.create') }}" class="btn btn-primary">Ajouter un emplacement</a>
  </div>
</div>
<div class="card">
  <h5 class="card-header">Liste des emplacements</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Rayon</th>
          <th>Etagère</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($emplacements as $emplacement)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$emplacement->rayon}}</strong></td>
          <td>{{$emplacement->numero_etagere	}}</td>
          
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <form method="POST" align="left">
                  <a class="dropdown-item" href="{{ route('gestion-listeEmplacements.show' , $emplacement->id) }}"><i class="bx bx-show me-1"></i> Afficher</a>
                  </form>
                  <form method="POST" align="left">
                    <a class="dropdown-item" href="{{ route('gestion-listeEmplacements.update' , $emplacement->id) }}"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                    </form>
                    <form action="{{ route('gestion-listeEmplacements.destroy', $emplacement->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet emplacement ?')">
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