@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a  href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('authors.index') }}">Penulis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buku</li>
                  </ol>
              </nav>
              <div class="card">
                  <div class="card-header">Buku
                    <a class="btn btn-success float-right" href="{{ route('export.books') }}">Export</a>
                    <a class="btn btn-primary float-right" style=" margin-right: 10px" href="{{ route('books.create') }}">Tambah</a>
                  </div>

                  <div class="card-body">
                      {!! $html->table(['class' => 'table-striped']) !!}
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@push('scripts')
  {!! $html->scripts() !!}
@endpush
