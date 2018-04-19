@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a  href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Buku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Buku</li>
                  </ol>
              </nav>
              <div class="card">
                  <div class="card-header">Data Buku</div>

                  {{-- {{ $author->name }} --}}
                  <div class="card-body">
                      Judul : <strong>{{ $book->title }}</strong> <br>
                      {{-- Penulis : <strong @if ($book->author->id == $author->id)@endif>{{ $author->name }}</strong> --}}
                      Jumlah : <strong>{{ $book->amount }}</strong> <br>
                      Cover : <br>
                       <image src="{{ asset('cover/' . $book->cover) }}"
                         class="rounded float-left" weight="200px" height="200px">
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
