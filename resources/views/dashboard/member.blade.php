@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td class="text-muted">Buku yang sedang dipinjam :</td>
                          <td>
                            @if ($borrowLogs->count() == 0)
                              Tidak ada buku yang dipinjam
                            @endif
                            <ul>
                              @foreach ($borrowLogs as $log)
                                <li>{{ $log->book->title }}</li>
                              @endforeach
                            </ul>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
