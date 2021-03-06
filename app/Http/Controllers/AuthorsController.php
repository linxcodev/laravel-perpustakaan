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

      return DataTables::of($authors)
      ->addColumn('action', function ($author)
      {
        return view('datatable._action',[
          'show_url' => route('authors.show', $author->id),
          'edit_url' => route('authors.edit', $author->id),
          'delete_url' => route('authors.destroy', $author->id),
          'confirm_message' => 'Yakin akan di hapus' . $author->name
        ]);
      })->toJson();
    }

    $html = $htmlBuilder->columns([
      ['data' => 'name', 'name'=> 'name', 'title' => 'Nama'],
      ['data' => 'action', 'name'=> 'action', 'title' => '', 'orderable' => false, 'searchable' => false],
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

  // show using data binding
  public function show(Author $author)
  {
    return view('authors.show', compact('author'));
  }

  // show using method general
  // public function show($id)
  // {
  //   $author = Author::findOrFail($id);
  //
  //   return view('authors.show', compact('author'));
  // }
  public function edit(Author $author)
  {
    return view('authors.edit', compact('author'));
  }

  public function update(Request $request, Author $author)
  {
    $request->validate([
      'name' => 'required|unique:authors,name,' . $author->id
    ],
    [
      'name.required' => 'Nama Harus diisi.',
      'name.unique' => 'Nama Tersebut Sudah ada.'
    ]);

    $author->update($request->only('name'));

    return redirect()->route('authors.index')->with('flash_notification',[
        'level' => 'success',
        'message' => 'Berhasil merubah data penulis dengan nama <strong
         class="text-primary">' . $author->name . '</strong>'
    ]);
  }

  public function destroy(Author $author)
  {
    if (!$author->delete()) {
      return redirect()->back();
    }

    return redirect()->route('authors.index')->with('flash_notification',[
        'level' => 'danger',
        'message' => 'Berhasil hapus data penulis dengan nama <strong
         class="text-primary">' . $author->name . '</strong>'
    ]);
  }
}
