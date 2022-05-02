<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_books', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Book::class, 'book_id');
            $table->foreignIdFor(User::class, 'user_id');
            $table->timestamp('issue_date');
            $table->timestamp('expected_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->integer('fines')->default(0);
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_books');
    }
}
