@extends('layouts/contentNavbarLayout')

@section('title', 'Gestion des - Emprunts')

@section('page-script')
@endsection

@section('content')


@php
$isEditing = isset($emprunt);
$emprunt = $emprunt ?? new App\Models\Emprunt;
@endphp

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Gestion des emprunts /</span> Emprunt
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Détails emprunt</h5>
      <!-- Emprunt -->
      
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ $isEditing ? route('gestion-listeLEmprunts.update', $emprunt->id) : route('gestion-listeLEmprunts.store') }}">
          @csrf
          @if($isEditing)
          @method('PUT')
          @endif
          <hr class="my-0">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="nom" class="form-label">Emprunteur</label>
              <select class="form-select @error('id') is-invalid @enderror" id="livre_id" name="emprunteur_id">
                <option value=""></option> <!-- Ajouter une option vide -->
                @foreach(\App\Models\utilisateur::pluck('nom', 'id') as $UserId => $UserNom)
                    <option value="{{ $UserId }}" {{ ($isEditing && $emprunt->emprunteur_id == $UserId) || old('livre_id') == $UserId ? 'selected' : '' }}>
                        {{ $UserNom }}
                    </option>
                @endforeach
            </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="nom" class="form-label">Livre</label>
              <select class="form-select @error('livre_id') is-invalid @enderror" id="livre_id" name="livre_id">
                <option value=""></option> <!-- Ajouter une option vide -->
                @foreach(\App\Models\livres::pluck('titre', 'id') as $livreId => $livreNom)
                    <option value="{{ $livreId }}" {{ ($isEditing && $emprunt->livre_id == $livreId) || old('livre_id') == $livreId ? 'selected' : '' }}>
                        {{ $livreNom }}
                    </option>
                @endforeach
            </select>
            
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Date emprunt</label>
              <input class="form-control @error('date_emprunt') is-invalid @enderror" type="date" name="date_emprunt" value="{{ $isEditing ? $emprunt->date_emprunt : now()}}" id="html5-date-input" />            </div>
            <div class="mb-3 col-md-6">
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Date de retour prévue</label>
                <input class="form-control @error('date_retour_prevue') is-invalid @enderror" type="date" name="date_retour_prevue" value="{{ $isEditing ? $emprunt->date_retour_prevue : old('date_retour_prevue') }}" id="html5-date-input" />
            </div>
            <div class="mb-3 col-md-6">
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Date de retour réelle</label>
                <input class="form-control" type="date" name="date_retour_reelle" value="{{ $isEditing ? $emprunt->date_retour_reelle : old('date_retour_reelle') }}" id="html5-date-input" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="memberType" class="form-label">Statut emprunt</label>
              <select class="form-select" id="memberType" name="statut_emprunt">
                <option value="">Sélectionnez le statut emprunt</option>
                <option value="en_cours" {{ ($isEditing && $emprunt->statut_emprunt == 'en_cours') || old('statut_emprunt') == 'en_cours' || !$isEditing ? 'selected' : '' }}>En cours</option>
                <option value="en_retard" {{ ($isEditing && $emprunt->statut_emprunt == 'en_retard') || old('statut_emprunt') == 'en_retard' ? 'selected' : '' }}>En retard</option>
                <option value="termine" {{ ($isEditing && $emprunt->statut_emprunt == 'termine') || old('statut_emprunt') == 'termine' ? 'selected' : '' }}>Terminé</option>
            </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="basic-default-message" name="biographieLab">Notes</label>
              <textarea id="basic-default-message" class="form-control" name="notes" placeholder="Entrer une remarque">{{ $isEditing ? $emprunt->notes : old('notes') }}</textarea>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">{{ $isEditing ? 'Enregistrer les modifications' : 'Ajouter' }}</button>
            <button type="reset" class="btn btn-outline-secondary">Annuler</button>
          </div>
        </form>
      </div>
      <!-- /Emprunt -->
    </div>
  </div>
</div>
@endsection
