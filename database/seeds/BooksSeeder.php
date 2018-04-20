<?php
use App\Book;
use App\User;
use App\Author;
use App\BorrowLog;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // sample penulis
        $author1 = Author::create(['name' => 'Ozan e']);
        $author2 = Author::create(['name' => 'khali gibran']);
        $author3 = Author::create(['name' => 'muhamad hasan']);

        $book1 = Book::create([
          'title' => 'Bait-bait puisi',
          'amount' => 3,
          'author_id' => $author1->id,
        ]);

        $book2 = Book::create([
          'title' => 'Bait-bait puisi1',
          'amount' => 5,
          'author_id' => $author2->id,
        ]);

        $book3 = Book::create([
          'title' => 'Bait-bait puisi2',
          'amount' => 7,
          'author_id' => $author3->id,
        ]);

        $member = User::where('email', 'member@mail.com')->first();

        BorrowLog::create([
          'user_id' => $member->id,
          'book_id' => $book1->id,
          'is_returned' => 0
        ]);

        BorrowLog::create([
          'user_id' => $member->id,
          'book_id' => $book2->id,
          'is_returned' => 0
        ]);

        BorrowLog::create([
          'user_id' => $member->id,
          'book_id' => $book3->id,
          'is_returned' => 1
        ]);

    }
}
