<?php

namespace App\Http\Controllers;

use App\BorrowLog;
use DataTables;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;

class StatisticsController extends Controller
{
    public function index(Request $request, Builder $builder)
    {
      if ($request->ajax()) {
        $statistics = BorrowLog::with('book', 'user');

        return DataTables::of($statistics)
        ->addColumn('returned_at', function ($statistic) {
          if ($statistic->is_returned) {
              return $statistic->updated_at->format('D-M-Y');
          }
          return "<strong class='text-danger'>Masih Dipinjam</strong>";
        })
        ->rawColumns(['returned_at'])
        ->toJson();
      }

      $html = $builder->columns([
        ['data' => 'book.title', 'name'=> 'book.title', 'title' => 'Judul'],
        ['data' => 'user.name', 'name'=> 'user.name', 'title' => 'Peminjam'],
        ['data' => 'created_at', 'name'=> 'created_at', 'title' => 'Tanggal Peminjaman'],
        ['data' => 'returned_at', 'name'=> 'returned_at', 'title' => 'Tanggal Kembali'],
      ]);

      return view('statistics.index', compact('html'));
    }
}
