@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
            {{-- <nav aria-label="breadcrumb">
              <ol class=breadcrumb"">

                  <li class="breadcrumb-item">
                    <a  href="{{ route('home') }}">Beranda</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Penulis
                  </li>

              </ol>
            </nav> --}}
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a  href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a  href="{{ route('authors.index') }}">Penulis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Penulis</li>
                  </ol>
              </nav>
              <div class="card">
                  <div class="card-header">Tambah Penulis</div>

                  <div class="card-body">
                    <form class="form-horizontal" action="{{ route('authors.store') }}" method="post">
                        @csrf
                        
                        @include('authors._form')
                      </form>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
@endsection
