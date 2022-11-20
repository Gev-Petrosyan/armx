<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citys', function (Blueprint $table) {
            $table->id();
            $table->string("city");
            $table->string("type")->nullable();
            $table->string("image")->nullable();
            $table->timestamps();
        });

        $native = [
            "Ялта",
            "Алушта",
            "Раствор"
        ];

        foreach ($native as $item) {
            DB::table('citys')->insert(
                array(
                    'city' => $item,
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
        Schema::dropIfExists('citys');
    }
}
