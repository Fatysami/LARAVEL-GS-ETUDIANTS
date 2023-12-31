@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')


@php
$isEditing = isset($utilisateur);
$utilisateur = $utilisateur ?? new App\Models\utilisateur;
@endphp

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Paramétrage du compte /</span> Compte
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Détails du profil</h5>
      <!-- Account -->
      
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ $isEditing ? route('gestion-listeUtilisateurs.update', $utilisateur->id) : route('gestion-listeUtilisateurs.store') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              @if ($isEditing && $utilisateur->photo)
              <img src="{{ asset('images/'.$utilisateur->photo) }}" alt="Avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
               @else
              <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
               @endif
                 <div class="button-wrapper">
                     <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                         <span class="d-none d-sm-block">Télécharger une photo</span>
                         <i class="bx bx-upload d-block d-sm-none"></i>
                         <input type="file" name="photo" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" onchange="previewImage(event)" />
                     </label>
                     <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" onclick="resetImage()">
                         <i class="bx bx-reset d-block d-sm-none"></i>
                         <span class="d-none d-sm-block">Annuler</span>
                     </button>
                   
                     <p class="text-muted mb-0">Autorisé JPG, GIF or PNG. Max size of 800K</p>
                 </div>
            </div>
          </div>
          <hr class="my-0">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="nom" class="form-label">Nom</label>
              <input class="form-control" type="text" id="nom" name="nom" value="{{ $isEditing ? $utilisateur->nom : old('nom') }}" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="{{ $isEditing ? $utilisateur->email : old('email') }}" placeholder="fatima.doe@example.com" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="memberType" class="form-label">Statut adhésion</label>
              <select class="form-select @error('type_membre') is-invalid @enderror" id="memberType" name="type_membre" value="{{ $isEditing ? $utilisateur->type_membre : old('type_membre') }}">
                  <option value="">Sélectionnez un type de membre</option>
                  <option value="étudiant" {{ ($isEditing && $utilisateur->type_membre == 'étudiant') || old('type_membre') == 'étudiant' ? 'selected' : '' }}>Etudiant</option>
                  <option value="professeur" {{ ($isEditing && $utilisateur->type_membre == 'professeur') || old('type_membre') == 'professeur' ? 'selected' : '' }}>Professeur ou chercheur</option>
                  <option value="personnel" {{ ($isEditing && $utilisateur->type_membre == 'personnel') || old('type_membre') == 'personnel' ? 'selected' : '' }}>Personnel administratif</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Numéro de téléphone</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">Maroc (+212)</span>
                <input type="text" id="phoneNumber" name="telephone" class="form-control" value="{{ $isEditing ? $utilisateur->telephone : old('telephone') }}" placeholder="666 21 00 00 00"/>
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="addresse" name="adresse" value="{{ $isEditing ? $utilisateur->adresse : old('adresse') }}" placeholder="Address" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="state" class="form-label">Ville</label>
              <input class="form-control" type="text" id="state" name="ville" value="{{ $isEditing ? $utilisateur->	ville : old('	ville') }}" placeholder="Casablanca" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="zipCode" class="form-label">Code postal</label>
              <input type="text" class="form-control" id="code_postal" name="code_postal" value="{{ $isEditing ? $utilisateur->code_postal : old('pays') }}" placeholder="20000" maxlength="6" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="country">Pays</label>
              <select id="country" class="form-select" name="pays" value="{{ $isEditing ? $utilisateur->pays : old('pays') }}">
                @foreach($pays as $pays)
                <option value="{{ $pays }}" {{ ($isEditing && $utilisateur->pays == $pays) || old('ville') == $pays ? 'selected' : '' }}>{{ $pays }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Enregistrer les modifications</button>
            <button type="reset" class="btn btn-outline-secondary">Annuler</button>
          </div>
          <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('uploadedAvatar');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        
            function resetImage() {
                var output = document.getElementById('uploadedAvatar');
                output.src = "{{ $isEditing ? $utilisateur->photo : old('utilisateur') }}";
                document.getElementById("uploadedAvatar").value = null;
            }
        </script>
        </form>
      </div>
      <!-- /Account -->
    </div>
    <div class="card">
      <h5 class="card-header">Supprimer le compte</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Êtes-vous sûr(e) de vouloir supprimer votre compte?</h6>
            <p class="mb-0">Une fois que vous supprimez votre compte, il n y a pas de retour en arrière possible. Veuillez être certain(e)..</p>
          </div>
        </div>
        <div style="display: flex; justify-content: left;">
          <form id="formAccountDeactivation" method="GET" action="/gestion/gestion-listeUtilisateurs/desactiver/{{ $utilisateur->id }}">
            @csrf   
            <button type="submit" class="btn btn-warning deactivate-account" style="margin-right: 10px;">Désactiver le compte</button>
          </form>
          <form id="formAccountDeactivation" method="GET" action="{{ route('gestion-listeUtilisateurs.destroy', $utilisateur->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger deactivate-account">Supprimer le compte</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
