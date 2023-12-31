@extends('layouts/blankLayout')
@section('title', 'Login Basic - Pages')
@section('page-style')

<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
              <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo/student-management.png') }}" alt="Logo" width="150" height="100">
            </span>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Welcome to {{config('variables.templateName')}}! 👋</h4>
          <p class="mb-4">Veuillez vous connecter à votre compte et commencer une aventure.</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('utilisateur.login') }}" method="GET">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Entrez votre mail" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Mot de passe</label>
                <a href="{{url('auth/forgot-password-basic')}}">
                  <small>Mot de passe oublié ?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  Se souvenir de moi
                </label>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Se connecter</button>
            </div>
          @if($errors->has('email'))
          <div class="alert alert-danger">{{ $errors->first('email') }}</div>
          @endif
          </form>

          <p class="text-center">
            <span>Nouveau sur notre plateforme ?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Créer un compte</span>
            </a>
          </p>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection
