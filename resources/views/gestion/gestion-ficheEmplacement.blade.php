@extends('layouts/contentNavbarLayout')
@section('title', ' Vertical Layouts - Forms')
@section('content')

@php
$isEditing = isset($emplacement);
@endphp

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramétrage/</span> {{ $isEditing ? 'Modifier' : 'Ajouter' }} un emplacement</h4>
<form method="POST" action="{{ $isEditing ? route('gestion-listeEmplacements.update', $emplacement->id) : route('gestion-listeEmplacements.store') }}">
  @csrf
  @if($isEditing)
    @method('PUT')
  @endif
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Fiche emplacement</h5> 
        </div>
        <div class="card-body">
            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Rayon</label>
              <input type="text" class="form-control" id="basic-default-fullname" name="rayon" value="{{ $isEditing ? $emplacement->rayon : old('rayon') }}" placeholder="Nom du rayon" />
            </div>
            <div class="mb-3">
              <label for="valeur" class="form-label">Etagère</label>
              <select id="valeur" name="numero_etagere" class="form-select" value="{{ $isEditing ? $emplacement->numero_etagere : old('numero_etagere') }}">
                  <option value="">Sélectionnez une étagère</option>
                  @for ($i = 1; $i <= 10; $i++)
                      <option value="{{ $i }}" @if($isEditing && $emplacement->numero_etagere == $i) selected @endif>{{ $i }}</option>
                  @endfor
              </select>
          </div>
            <div class="d-flex">
              <button type="submit" class="btn btn-primary me-2">{{ $isEditing ? 'Enregistrer les modifications' : 'Ajouter' }}</button>
              <a href="{{ route('gestion-listeEmplacements.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection