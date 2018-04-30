<?php

namespace App\Http\Controllers;

use Excel;
use App\Book;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookImportController extends Controller
{
  public function generateExcelTemplate()
  {
    Excel::create('Template Import Buku', function ($excel) {
      $excel->setTitle('Template Import Buku')
            ->setCreator('Perpustakaan Online')
            ->setCompany('Perpustakaan Online')
            ->setDescription('Template import buku untuk perpustakaan online');

      $excel->sheet('Data Buku', function ($sheet) {
        $row = 1;
        $sheet->row($row, [
          'judul',
          'penulis',
          'jumlah'
        ]);
      });
    })->export('xls');
  }

  public function importExcel(Request $request)
  {
    $request->validate([
      'excel' => 'required|mimes:xls,xlsx,ods'
    ]);

    $excel = $request->excel;

    // baca sheet pertama
    $excels = Excel::selectSheetsByIndex(0)->load($excel)->get();

    // validasi pada file Excel
    $rowRules = [
      'judul' => 'required|unique:books,title',
      'penulis' => 'required',
      'jumlah' => 'required'
    ];

    // catat semua buku untuk menghitung semua buku yang berhasil diimport
    $book_id = [];

    // looping dari baris nomor 2, baris satu nama kolom
    foreach ($excels as $row) {
      // validasi role excel
      $validator = Validator::make($row->toArray(), $rowRules);

      // lewati baris yang tidak valid dan lanjut ke baris berikutnya
      if ($validator->fails()) {
        continue;
      }

      // jika valid maka eksekusi & cek apakah penulis ada di database
      $author = Author::where('name', $row['penulis'])->first();

      // buat penulis jika belum tercatat di database
      if (!$author) {
        Author::create(['name' => $row['penulis']]);
      }

      // buat buku baru
      $book = Book::create([
        'title' => $row['judul'],
        'author_id' => $author->id,
        'amount' => $row['jumlah']
      ]);

      // catat ID buku yang telah dibuat
      array_push($book_id, $book->id) ;
    }

    // dapatkan semua buku yang baru dibuat
    $books = Book::whereIn('id', $book_id)->get();

    // redirect ke form jika tidak ada buku yang behasil diimport
    if ($books->count() == 0) {
      return redirect()->back()->with('flash_notification', [
        'level' => 'danger',
        'message' => 'Tidak ada buku yang berhasil diimport atau sudah ada buku'
      ]);
    }

    // jika berhasil tampilkan index Buku
    return redirect()->route('books.index')->with('flash_notification', [
      'level' => 'success',
      'message' => 'Berhasil mengimport ' . $books->count() . ' buku'
    ]);
  }
}
