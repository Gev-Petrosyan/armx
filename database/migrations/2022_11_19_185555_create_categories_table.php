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
            $table->string("category");
            $table->string("type");
            $table->string("image")->nullable();
            $table->timestamps();
        });

        $native = [
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

        foreach ($native as $item) {
            DB::table('categories')->insert(
                array(
                    'category' => $item,
                    'type' => 'native'
                )
            );
        }
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
