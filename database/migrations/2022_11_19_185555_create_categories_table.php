<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            $table->string("category");
            $table->integer("categoryID")->nullable();
            $table->string("image")->nullable();
            $table->timestamps();
        });

        // testings

        $subcategories = [
            "Балки, фермы",
            "Диафрагмы жесткости",
            "ЖБИ для строительства железных дорог",
            "Железобетонные стеновые панели",
            "Заборы, фундаменты заборов",
            "Колонны, ригели",
            "Кольца, крышки, днища, трубы",
            "Лестничные марши, площадки, балки, ступени",
            "Лотки УБК, плиты УБК, бруски БК",
            "Лотки, элементы каналов"
        ];

        foreach ($subcategories as $subcategory) {
            DB::table('categories')->insert(array(
                'category' => $subcategory,
                'categoryID' => rand(11,13),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ));
        }

        DB::table('categories')->insert(array(
            'category' => 'Категория один',
            'categoryID' => NULL,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ));

        DB::table('categories')->insert(array(
            'category' => 'Категория два',
            'categoryID' => NULL,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ));

        DB::table('categories')->insert(array(
            'category' => 'Категория три',
            'categoryID' => NULL,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ));

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
