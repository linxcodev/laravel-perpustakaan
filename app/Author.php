<?php

namespace App;

use Session;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  protected $fillable = [
      'name'
  ];

  // mendapatkan book Model
  public function books()
  {
    return $this->hasMany(Book::class);
  }

  public static function boot()
  {
    parent::boot();

    self::deleting(function ($author) {
      //  cek apakah penulis punya buku
      if ($author->books->count() > 0) {
        // buat pesan erorr
        $messageHtml = 'Penulis Tidak bisa dihapus karena memiliki buku';
        $messageHtml .= '<ul>';

        foreach ($author->books as $book) {
          $messageHtml .= "<li>$book->title</li>";
        }

        $messageHtml .= '<ul>';

        Session::flash('flash_notification', [
          'level' => 'danger',
          'message' => $messageHtml,
        ]);

        // Batalkan Proses hapus Penulis
        return false;
      }
    });
  }
}
