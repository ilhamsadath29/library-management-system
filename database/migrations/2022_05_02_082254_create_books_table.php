<?php

use App\Models\Author;
use App\Models\Category;
use App\Models\RackLocation;
use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Setting::class, 'site_id');
            $table->foreignIdFor(Category::class, 'category_id');
            $table->foreignIdFor(Author::class, 'author_id');
            $table->foreignIdFor(RackLocation::class, 'rack_id');
            $table->string('name', 255);
            $table->string('isbn', 100);
            $table->mediumInteger('no_of_copy');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
