<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('lib_name', 200);
            $table->string('lib_address', 255);
            $table->string('lib_contact_number', 30);
            $table->mediumInteger('lib_total_book_issue_day');
            $table->decimal('lib_one_day_fine', 4, 2);
            $table->smallInteger('lib_issue_total_book_per_user');
            $table->string('lib_currency', 30);
            $table->string('lib_timezone', 100);
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
        Schema::dropIfExists('settings');
    }
}
