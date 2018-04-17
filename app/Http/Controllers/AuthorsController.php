<?php

namespace App\Http\Controllers;

use Session;
use App\Author;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class AuthorsController extends Controller
{
  public function index(Request $request, Builder $htmlBuilder)
  {
    // cara biasa
    // $authors = Author::all();
    //
    // return view('authors.index', compact('authors'));

    // cara DataTables
    if ($request->ajax()) {
      $authors = Author::all();
      return DataTables::of($authors)->toJson();
    }

    $html = $htmlBuilder->columns([
      ['data' => 'name', 'name'=> 'name', 'title' => 'Nama']
    ]);

    return view('authors.index', compact('html'));
  }

  public function create()
  {
    return view('authors.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|unique:authors'
    ],
    [
      'name.required' => 'Nama Harus diisi.',
      'name.unique' => 'Nama Tersebut Sudah ada.'
    ]);

    $author = Author::create($request->all());

    // Session::flash('flash_notification',[
    //   'level' => 'success',
    //   'message' => 'Berhasil menyimpan data penulis dengan nama '.$author->name
    // ]);

    return redirect()->route('authors.index')->with('flash_notification',[
        'level' => 'success',
        'message' => 'Berhasil menyimpan data penulis dengan nama '.$author->name
    ]);
  }
}