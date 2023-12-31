@extends('layouts/contentNavbarLayout')
@section('title', ' Vertical Layouts - Forms')
@section('content')

@php
$isEditing = isset($categorie);
@endphp

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramétrage/</span> {{ $isEditing ? 'Modifier' : 'Ajouter' }} une catégorie</h4>
<form method="POST" action="{{ $isEditing ? route('gestion-listeCategories.update', $categorie->id) : route('gestion-listeCategories.store') }}">
  @csrf
  @if($isEditing)
    @method('PUT')
    <input type="hidden" name="id" value="{{ $categorie->id }}">
  @endif
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Fiche catégorie</h5> 
        </div>
        <div class="card-body">
            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Libellé</label>
              <input type="text" class="form-control" id="basic-default-fullname" name="nom_categorie" value="{{ $isEditing ? $categorie->nom_categorie : old('nom_categorie') }}" placeholder="Libellé" />
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">Statut</label>
              <select id="defaultSelect" class="form-select" name="statut_categorie">
                <option></option>
                <option value="Active" {{ $isEditing && $categorie->statut_categorie == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $isEditing && $categorie->statut_categorie == 'Inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="basic-default-message">Déscription</label>
              <textarea id="basic-default-message" class="form-control" name="description" placeholder="Entrer une déscription de la catégorie">{{ $isEditing ? $categorie->description : old('description') }}</textarea>
            </div>
            <div class="d-flex">
              <button type="submit" class="btn btn-primary me-2">{{ $isEditing ? 'Enregistrer les modifications' : 'Ajouter' }}</button>
              <a href="{{ route('gestion-listeCategories.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection