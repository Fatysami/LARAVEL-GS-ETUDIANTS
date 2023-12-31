@extends('layouts/contentNavbarLayout')
@section('title', ' Vertical Layouts - Forms')
@section('content')

@php
$isEditing = isset($livre);
$livre = $livre ?? new App\Models\livres;
$auteurs = App\Models\auteurs::all();
$categories = App\Models\Categories::all();
$emplacements = App\Models\emplacements::all();
@endphp

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramétrage/</span> {{ $isEditing ? 'Modifier' : 'Ajouter' }} un livre</h4>
<form method="POST" action="{{ $isEditing ? route('gestion-listeLivres.update', $livre->id) : route('gestion-listeLivres.store') }}" enctype="multipart/form-data">
  @csrf
  @if($isEditing)
    @method('PUT')
  @endif

  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Fiche Livre</h5>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          @if ($isEditing && $livre->image_couverture)
         <img src="{{ asset('images/'.$livre->image_couverture) }}" alt="Couverture" class="d-block rounded" height="100" width="100" id="uploadedCouverture" />
          @else
         <img src="{{ asset('images/placeholder.jpg') }}" alt="Couverture" class="d-block rounded" height="100" width="100" id="uploadedCouverture" />
          @endif
          
          @if(session('user_type') != 'étudiant')
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Télécharger une couverture</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input type="file" name="image_couverture" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" onchange="previewImage(event)" />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" onclick="resetImage()">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Annuler</span>
            </button>
          
            <p class="text-muted mb-0">Autorisé JPG, GIF or PNG. Max size of 800K</p>
           @endif
        </div>
      </div>
    </div>
          <div class="card-body">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label">Titre</label>
                  <input type="text" class="form-control @error('titre') is-invalid @enderror" id="basic-default-fullname" name="titre" value="{{ $isEditing ? $livre->titre : old('titre') }}" placeholder="" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">ISBN</label>
                  <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="basic-default-fullname" name="isbn" value="{{ $isEditing ? $livre->isbn : old('isbn') }}" placeholder="" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="auteur">Auteur</label>
              <select class="form-control @error('auteur_id') is-invalid @enderror" id="auteur" name="auteur_id">
                <option value="">-- Sélectionner un auteur --</option>
                @foreach($auteurs as $auteur)
                  <option value="{{ $auteur->id }}" {{ $livre->auteur_id == $auteur->id ? 'selected' : '' }}>{{ $auteur->nom }} {{ $auteur->prenom }}</option>
                @endforeach
              </select>
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="categ">Catégorie</label>
              <select class="form-control @error('categ_id') is-invalid @enderror" id="categ" name="categ_id">
                <option value="">-- Sélectionner une catégorie --</option>
                @foreach($categories as $categorie)
                  <option value="{{ $categorie->id }}" {{ $livre->categ_id == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom_categorie }}</option>
                @endforeach
              </select>
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="emplacement">Emplacement</label>
                  <select class="form-control @error('emplacement_id') is-invalid @enderror" id="emplacement" name="emplacement_id">
                    <option value="">-- Sélectionner un emplacement --</option>
                    @foreach($emplacements as $emplacement)
                      <option value="{{ $emplacement->id }}" {{ $livre->emplacement_id  == $emplacement->id ? 'selected' : '' }}>{{ $emplacement->rayon }} {{ $emplacement->numero_etagere }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="annee_publication" class="col-md-3 col-form-label">Année publication</label>
                      <select class="form-control" name="annee_publication" id="annee_publication">
                          <option value="">Sélectionner une année</option>
                          @for($i = date('Y'); $i >= 1900; $i--)
                              <option value="{{ $i }}" {{ ($isEditing ? $livre->annee_publication : old('annee_publication')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                          @endfor
                      </select>
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-default-fullname">Nombre de copie disponible</label>
                <input type="number" class="form-control" id="basic-default-fullname" name="disponibilite" value="{{ $isEditing ? $livre->disponibilite : old('disponibilite') }}"/>
              </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-message" name="biographieLab">Description</label>
                  <textarea id="basic-default-message" class="form-control" name="description" placeholder="Entrer la description du livre">{{ $isEditing ? $livre->description : old('description') }}</textarea>
                </div>
              <div class="mt-2">
                @if(session('user_type') != 'étudiant')
                <button type="submit" class="btn btn-primary me-2">{{ $isEditing ? 'Enregistrer les modifications' : 'Ajouter' }}</button>
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('gestion-listeLivres.index') }}'">Annuler</button>
                @else
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('gestion-listeLivres.VueCartes') }}'">Annuler</button>
                @endif
              
                
              </div>
          </div>
      </div>

      <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('uploadedCouverture');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    
        function resetImage() {
            var output = document.getElementById('uploadedCouverture');
            output.src = "{{ $isEditing ? $livre->image_couverture : old('image_couverture') }}";
            document.getElementById("upload").value = null;
        }
    </script>
</form>
@endsection