@extends('layouts/contentNavbarLayout')
@section('title', ' Vertical Layouts - Forms')
@section('content')

@php
$isEditing = isset($auteur);
$nationalites = include resource_path('Lang\nationalites.php');
@endphp

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramétrage/</span> {{ $isEditing ? 'Modifier' : 'Ajouter' }} un auteur</h4>
<form method="POST" action="{{ $isEditing ? route('gestion-listeAuteurs.update', $auteur->id) : route('gestion-listeAuteurs.store') }}">
  @csrf
  @if($isEditing)
    @method('PUT')
  @endif
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Fiche auteur</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Nom</label>
              <input type="text" class="form-control" id="basic-default-fullname" name="nom" value="{{ $isEditing ? $auteur->nom : old('nom') }}" placeholder="" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Prénom</label>
              <input type="text" class="form-control" id="basic-default-fullname" name="prenom" value="{{ $isEditing ? $auteur->prenom : old('prenom') }}" placeholder="" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="basic-default-nationalite">Nationalité</label>
              <select class="form-select" id="basic-default-nationalite" name="nationalite">
                <option value="">-- Sélectionner une nationalité --</option>
                @foreach($nationalites as $code => $nom)
                  <option value="{{ $code }}" {{ $isEditing && $auteur->nationalite == $code ? 'selected' : '' }}>{{ $nom }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 row">
              <label for="html5-date-input" class="col-md-2 col-form-label" >Date naissance</label>
              <div class="col-md-10">
                <input class="form-control" type="date" name="date_naissance" value="{{ $isEditing ? $auteur->date_naissance : old('date_naissance') }}" id="html5-date-input" />
              </div>
            </div>
            <div class="mb-3 row">
              <label for="html5-date-input" class="col-md-2 col-form-label" >Date de décès</label>
              <div class="col-md-10">
                <input class="form-control" type="date" name="date_deces" value="{{ $isEditing ? $auteur->date_deces : old('date_deces') }}" id="html5-date-input" />
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="basic-default-message" name="biographieLab">Biographie</label>
              <textarea id="basic-default-message" class="form-control" name="biographie" placeholder="Entrer la biographie de l'auteur">{{ $isEditing ? $auteur->biographie : old('biographie') }}</textarea>
            </div>
            <div class="d-flex">
              <button type="submit" class="btn btn-primary me-2">{{ $isEditing ? 'Enregistrer les modifications' : 'Ajouter' }}</button>
              <a href="{{ route('gestion-listeAuteurs.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection