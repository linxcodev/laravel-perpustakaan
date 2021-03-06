<?php

namespace App\Http\Controllers;

use App\Book;
use DataTables;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Laratrust\LaratrustFacade as Laratrust;

class GuestController extends Controller
{
  public function index(Request $request, Builder $builder)
  {
      if ($request->ajax()) {
        $books = Book::with('author')->get();

        return DataTables::of($books)
        ->addColumn('action', function ($book) {
            if (Laratrust::hasRole('admin')) {
                return '';
            }

            return '<a href="' . route('guest.books.borrow', $book->id) . '"
            class="btn btn-xs btn-primary">Pinjam Buku</a>';
        })
        ->addColumn('stock', function ($book) {
          return $book->stock;
        })
        ->toJson();
      }

      $html = $builder->columns([
        ['data' => 'title', 'name'=> 'title', 'title' => 'Judul Buku'],
        ['data' => 'stock', 'name'=> 'stock', 'title' => 'Jumlah Buku'],
        ['data' => 'author.name', 'name'=> 'author.name', 'title' => 'Penulis'],
        ['data' => 'action', 'name'=> 'action', 'title' => '', 'orderable' => false, 'searchable' => false],
      ]);

      return view('guest.index', compact('html'));
  }
}
