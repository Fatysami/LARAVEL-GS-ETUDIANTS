@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection


@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">

      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
              <span class="app-brand-logo demo"> <img src="{{ asset('assets/img/logo/student-management.png') }}" alt="Logo" width="50" height="50"></span>
              <span class="app-brand-text demo text-body fw-bolder">{{config('variables.templateName')}}</span>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Votre aventure commence ici 🚀</h4>
          <p class="mb-4">Rejoignez la bibliothèque et ouvrez la porte à un monde de connaissances, de découvertes et de merveilles littéraires!</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('utilisateur.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="memberType" class="form-label">Statut adhésion</label>
              <select class="form-control @error('type_membre') is-invalid @enderror" id="memberType" name="type_membre">
                  <option value="">Sélectionnez un type de membre</option>
                  <option value="étudiant">Étudiant</option>
                  <option value="professeur">Professeur ou chercheur</option>
                  <option value="personnel">Personnel administratif</option>
              </select>
          </div>
            <div class="mb-3">
              <label for="username" class="form-label">Utilisateur</label>
              <input type="text" class="form-control @error('nom') is-invalid @enderror" id="username" name="nom" placeholder="Entrez votre nom" autofocus>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Entrer votre E-mail">
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Mot de passe</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                <label class="form-check-label" for="terms-conditions">
                  J&rsquo;accepte la
                  <a href="javascript:void(0);">Politique de confidentialité</a>
                </label>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">
              Créer un compte
            </button>
          </form>

          <p class="text-center">
            <span>Vous êtes déjà inscrit(e)</span>
            <a href="{{url('auth/login-basic')}}">
              <span>Connectez-vous !</span>
            </a>
          </p>
        </div>
      </div>
    </div>
    <!-- Register Card -->
  </div>
</div>
</div>
@endsection
