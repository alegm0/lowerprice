<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddGendersCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $genders = [
            [
                "id" => 1,
                "name" => "Femenino",
                "code" => "F"
            ],
            [
                "id" => 2,
                "name" => "Masculino",
                "code" => "M"
            ]
        ];
        DB::table('genders')->insert($genders);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('genders')->truncate();
    }
}
