@extends('layouts/contentNavbarLayout')

@section('title', 'Emprunts')

@section('content')

@if(!request()->has('recherche'))
    @php
    $Emprunts = App\Models\Emprunt::all(); // récupérer tous les auteurs depuis la base de données
    @endphp
@endif
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Paramétrage /</span> Liste des emprunts
</h4>
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Actions</h5>
    <!-- Search -->
    <form action="{{ route('gestion-listeLEmprunts.Search') }}" method="POST" class="navbar-nav align-items-center">
        @csrf
        <div class="nav-item d-flex align-items-center me-3">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="recherche" class="form-control border-0 shadow-none" placeholder="Recherche..." aria-label="Recherche...">
            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
            <a href="{{ route('gestion-listeLEmprunts.index') }}" class="btn btn-secondary ms-2">Actualiser</a>
        </div>
    </form>
    <!-- /Search -->
    <a href="{{ route('gestion-listeLEmprunts.create') }}" class="btn btn-primary">Ajouter un Emprunt</a>
  </div>
</div>
<div class="card">
  <h5 class="card-header">Liste des emprunts</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Livre</th>
          <th>Emprunteur</th>
          <th>Date emprunt</th>
          <th>Date de retour prévue</th>
          <th>Date de retour réelle</th>
          <th>Statut</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($Emprunts as $Emprunt)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ App\Models\livres::find($Emprunt->livre_id)->titre }}</strong></td>
          <td>{{ App\Models\utilisateur::find($Emprunt->emprunteur_id)->nom }}</td>
          <td>{{$Emprunt->date_emprunt}}</td>
          <td>{{$Emprunt->date_retour_prevue}}</td>
          <td>{{$Emprunt->date_retour_reelle}}</td>
          @if ($Emprunt->statut_emprunt == 'en_cours')
          <td><span class="badge bg-label-info me-1">En cours</td>
          @elseif ($Emprunt->statut_emprunt == 'en_retard')
          <td><span class="badge bg-label-warning me-1">En retard</td>
          @else
          <td><span class="badge bg-label-success me-1">Terminé</td>
          @endif
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <form method="POST" align="left">
                  <a class="dropdown-item" href="{{ route('gestion-listeLEmprunts.show' , $Emprunt->id) }}"><i class="bx bx-show me-1"></i> Afficher</a>
                  </form>
                  <form method="POST" align="left">
                    <a class="dropdown-item" href="{{ route('gestion-listeLEmprunts.update' , $Emprunt->id) }}"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                    </form>
                    <form action="{{ route('gestion-listeLEmprunts.destroy', $Emprunt->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet auteur ?')">
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