<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddCountriesCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $countries = [
            [
                'id' => 46,
                'name' => 'Colombia',
                'code' => 'CO',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 243,
                'name' => 'Venezuela',
                'code' => 'VE',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 12,
                'name' => 'Argentina',
                'code' => 'AR',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 43,
                'name' => 'Chile',
                'code' => 'CL',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 178,
                'name' => 'Perú',
                'code' => 'PE',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 177,
                'name' => 'Paraguay',
                'code' => 'PY',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 150,
                'name' => 'México',
                'code' => 'MX',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 175,
                'name' => 'Panamá',
                'code' => 'PA',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 31,
                'name' => 'Brasil',
                'code' => 'BR',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 57,
                'name' => 'Ecuador',
                'code' => 'EC',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ]
        ];

        DB::table('countries')->insert($countries);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('countries')->truncate();
    }
}
