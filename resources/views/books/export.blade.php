@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a  href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a  href="{{ route('books.index') }}">Buku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Export Buku</li>
                  </ol>
              </nav>
              <div class="card">
                  <div class="card-header">Export Buku</div>
                  <div class="card-body">
                    <form class="form-horizontal" action="{{ route('export.books.post') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                          <label for="name" class="col-md-2 control-label">Penulis</label>
                          <div class="col-md-10">
                            <select class="form-control {{ $errors->has('author_id') ? 'is-invalid' : '' }} js-selectize"
                              name="author_id[]" multiple placeholder="pilih penulis">
                              @foreach ($authors as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('author_id'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('author_id') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group float-right">
                          <div class="col-md-4 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">Download</button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
@endsection
