<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddDepartmentsCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $departments = [
            [
                'id' => 1,
                'country_id' => 46,
                'name' => 'Amazonas',
                'code' => '91',
            ],
            [
                'id' => 2,
                'country_id' => 46,
                'name' => 'Antioquia',
                'code' => '05',
            ],
            [
                'id' => 3,
                'country_id' => 46,
                'name' => 'Arauca',
                'code' => '81',
            ],
            [
                'id' => 4,
                'country_id' => 46,
                'name' => 'Atlántico',
                'code' => '08',
            ],
            [
                'id' => 5,
                'country_id' => 46,
                'name' => 'Bogotá',
                'code' => '11',
            ],
            [
                'id' => 6,
                'country_id' => 46,
                'name' => 'Bolivar',
                'code' => '13',
            ],
            [
                'id' => 7,
                'country_id' => 46,
                'name' => 'Boyacá',
                'code' => '15',
            ],
            [
                'id' => 8,
                'country_id' => 46,
                'name' => 'Caldas',
                'code' => '17',
            ],
            [
                'id' => 9,
                'country_id' => 46,
                'name' => 'Caquetá',
                'code' => '18',
            ],
            [
                'id' => 10,
                'country_id' => 46,
                'name' => 'Casanare',
                'code' => '85',
            ],
            [
                'id' => 11,
                'country_id' => 46,
                'name' => 'Cauca',
                'code' => '19',
            ],
            [
                'id' => 12,
                'country_id' => 46,
                'name' => 'Cesar',
                'code' => '20',
            ],
            [
                'id' => 13,
                'country_id' => 46,
                'name' => 'Chocó',
                'code' => '27',
            ],
            [
                'id' => 14,
                'country_id' => 46,
                'name' => 'Córdoba',
                'code' => '23',
            ],
            [
                'id' => 15,
                'country_id' => 46,
                'name' => 'Cundinamarca',
                'code' => '25',
            ],
            [
                'id' => 16,
                'country_id' => 46,
                'name' => 'Guainía',
                'code' => '94',
            ],
            [
                'id' => 17,
                'country_id' => 46,
                'name' => 'Guaviare',
                'code' => '95',
            ],
            [
                'id' => 18,
                'country_id' => 46,
                'name' => 'Huila',
                'code' => '41',
            ],
            [
                'id' => 19,
                'country_id' => 46,
                'name' => 'La Guajira',
                'code' => '44',
            ],
            [
                'id' => 20,
                'country_id' => 46,
                'name' => 'Magdalena',
                'code' => '47',
            ],
            [
                'id' => 21,
                'country_id' => 46,
                'name' => 'Meta',
                'code' => '50',
            ],
            [
                'id' => 22,
                'country_id' => 46,
                'name' => 'Nariño',
                'code' => '52',
            ],
            [
                'id' => 23,
                'country_id' => 46,
                'name' => 'Norte de Santander',
                'code' => '54',
            ],
            [
                'id' => 24,
                'country_id' => 46,
                'name' => 'Putumayo',
                'code' => '86',
            ],
            [
                'id' => 25,
                'country_id' => 46,
                'name' => 'Quindío',
                'code' => '63',
            ],
            [
                'id' => 26,
                'country_id' => 46,
                'name' => 'Risaralda',
                'code' => '66',
            ],
            [
                'id' => 27,
                'country_id' => 46,
                'name' => 'San Andrés y Providencia',
                'code' => '88',
            ],
            [
                'id' => 28,
                'country_id' => 46,
                'name' => 'Santander',
                'code' => '68',
            ],
            [
                'id' => 29,
                'country_id' => 46,
                'name' => 'Sucre',
                'code' => '70',
            ],
            [
                'id' => 30,
                'country_id' => 46,
                'name' => 'Tolima',
                'code' => '73',
            ],
            [
                'id' => 31,
                'country_id' => 46,
                'name' => 'Valle del Cauca',
                'code' => '76',
            ],
            [
                'id' => 32,
                'country_id' => 46,
                'name' => 'Vaupés',
                'code' => '97',
            ],
            [
                'id' => 33,
                'country_id' => 46,
                'name' => 'Vichada',
                'code' => '99',
            ],


        ];


        DB::table('departments')->insert($departments);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('departments')->truncate();
    }
}
