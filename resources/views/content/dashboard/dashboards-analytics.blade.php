@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('content')
<div class="row">
  <div class="col-12 mb-4 order-0 mx-auto">
    <div class="card h-100">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Bienvenue  {{ session('user_nom') }}! 🎉</h5>
            <p class="mb-4">Entrez dans notre bibliothèque pour explorer des mondes inconnus et vous perdre dans des histoires captivantes. La lecture vous attend!</p>

          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </div>
 
</div>
@endsection
