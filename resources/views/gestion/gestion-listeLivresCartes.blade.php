@extends('layouts/contentNavbarLayout')

@section('title', 'Cards basic   - UI elements')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
@if(!request()->has('recherche'))
    @php
    $livres = App\Models\livres::all(); // récupérer tous les auteurs depuis la base de données
    @endphp
@endif
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Liste livres /</span> Vue Cartes</h4>
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Actions</h5>
    <!-- Search -->
    <form action="{{ route('gestion-listeLivres.SearchCarte') }}" method="POST" class="navbar-nav align-items-center">
        @csrf
        <div class="nav-item d-flex align-items-center me-3">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="recherche" class="form-control border-0 shadow-none" placeholder="Recherche..." aria-label="Recherche...">
            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
            <a href="{{ route('gestion-listeLivres.VueCartes') }}" class="btn btn-secondary ms-2">Actualiser</a>
        </div>
    </form>
    <!-- /Search -->
  </div>
</div>
<!-- Examples -->
<div class="row">
  @foreach($livres as $livre)
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">{{ $livre->titre }}</h5>
          <h6 class="card-subtitle text-muted">{{$livre->auteur ?  $livre->auteur->nom . ' ' . $livre->auteur->prenom : '' }}</h6>
          @if (!empty($livre->image_couverture))
          <img src="{{ asset('images/'.$livre->image_couverture) }}" alt="Couverture" class="d-block rounded" height="100" width="100" id="uploadedCouverture" />
           @else
          <img src="{{ asset('images/placeholder.jpg') }}" alt="Couverture" class="d-block rounded" height="100" width="100" id="uploadedCouverture" />
           @endif
          <p class="card-text">{{ substr($livre->description, 0, 100) }}...</p>
          <a href="{{ route('gestion-listeLivres.show' , $livre->id) }}" class="card-link">Voir plus</a>
          <a href="javascript:void(0);" class="card-link">Emprunter</a>
        </div>
      </div>
    </div>
  @endforeach
<!-- Examples -->
@endsection
