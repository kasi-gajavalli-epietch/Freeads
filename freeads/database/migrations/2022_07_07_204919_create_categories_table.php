<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['title' => 'Bikes'],
            ['title' => 'Cars'],
            ['title' => 'Mobiles'],
            ['title' => 'Furnitures'],
            ['title' => 'Appliances'],
            ['title' => 'Multimedia'],
            ['title' => 'Books'],
            ['title' => 'Other'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
