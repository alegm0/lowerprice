<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddCitiesCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cities = [
            [
                'id' => 149,
                'department_id' => 5,
                'name' => 'Bogotá D.C.',
                'code' => '11001',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],[
                'id' => 150,
                'department_id' => 6,
                'name' => 'Cartagena De Indias',
                'code' => '13001',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 366,
                'department_id' => 11,
                'name' => 'Bolívar',
                'code' => '19100',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 657,
                'department_id' => 20,
                'name' => 'Santa Marta',
                'code' => '47001',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 687,
                'department_id' => 21,
                'name' => 'Villavicencio',
                'code' => '50001',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 716,
                'department_id' => 22,
                'name' => 'Pasto',
                'code' => '52001',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 780,
                'department_id' => 23,
                'name' => 'San José De Cúcuta',
                'code' => '54001',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 516,
                'department_id' => 15,
                'name' => 'Mosquera',
                'code' => '25473',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 1,
                'department_id' => 2,
                'name' => 'Medellín',
                'code' => '05001',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
            [
                'id' => 1006,
                'department_id' => 31,
                'name' => 'Cali',
                'code' => '76001',
                'created_at' => '2021-06-11 16:10:07',
                'updated_at' => '2021-06-11 16:10:07',
            ],
        ];
        DB::table('cities')->insert($cities);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('cities')->truncate();
    }
}
