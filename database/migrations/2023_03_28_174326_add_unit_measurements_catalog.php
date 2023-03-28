<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddUnitMeasurementsCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $unitMeasurements = [
            [
                'id' => 1,
                'name' => 'Spray pequeño',
                'code' => '04',
            ],
            [
                'id' => 2,
                'name' => 'Levantar',
                'code' => '05',
            ],
            [
                'id' => 3,
                'name' => 'Lote calor',
                'code' => '08',
            ],
            [
                'id' => 4,
                'name' => 'Grupo',
                'code' => '10',
            ],
            [
                'id' => 5,
                'name' => 'Equipar',
                'code' => '11',
            ],
            [
                'id' => 6,
                'name' => 'Ración',
                'code' => '13',
            ],
            [
                'id' => 7,
                'name' => 'Disparo',
                'code' => '14',
            ],
            [
                'id' => 8,
                'name' => 'Palo',
                'code' => '15',
            ],
            [
                'id' => 9,
                'name' => 'Tambor de ciento quince kg',
                'code' => '16',
            ],
            [
                'id' => 10,
                'name' => 'Tambor de cien libras',
                'code' => '17',
            ],
            [
                'id' => 11,
                'name' => 'Tambor de cincuenta y cinco galones (us)',
                'code' => '18',
            ],
            [
                'id' => 12,
                'name' => 'Camión cisterna',
                'code' => '19',
            ],
            [
                'id' => 13,
                'name' => 'Contenedor de veinte pies',
                'code' => '20',
            ],
            [
                'id' => 14,
                'name' => 'Contenedor de cuarenta pies',
                'code' => '21',
            ],
            [
                'id' => 15,
                'name' => 'Decilitro por gramo',
                'code' => '22',
            ],
            [
                'id' => 16,
                'name' => 'Gramo por centímetro cúbico',
                'code' => '23',
            ],
            [
                'id' => 17,
                'name' => 'Libra teórica',
                'code' => '24',
            ],
            [
                'id' => 18,
                'name' => 'Gramo por centímetro cuadrado',
                'code' => '25',
            ],
            [
                'id' => 19,
                'name' => 'Tonelada real',
                'code' => '26',
            ],
            [
                'id' => 20,
                'name' => 'Tonelada teórica',
                'code' => '27',
            ],
            [
                'id' => 21,
                'name' => 'Kilogramo por metro cuadrado',
                'code' => '28',
            ],
            [
                'id' => 22,
                'name' => 'Libra por mil pies cuadrados',
                'code' => '29',
            ],
            [
                'id' => 23,
                'name' => 'Día de potencia del caballo por tonelada métrica seca al aire.',
                'code' => '30',
            ],
            [
                'id' => 24,
                'name' => 'Coger peso',
                'code' => '31',
            ],
            [
                'id' => 25,
                'name' => 'Kilogramo por aire seco tonelada métrica',
                'code' => '32',
            ],
            [
                'id' => 26,
                'name' => 'Kilopascales metros cuadrados por gramo',
                'code' => '33',
            ],
            [
                'id' => 27,
                'name' => 'Kilopascales por milímetro',
                'code' => '34',
            ],
            [
                'id' => 28,
                'name' => 'Mililitros por centímetro cuadrado segundo',
                'code' => '35',
            ],
            [
                'id' => 29,
                'name' => 'Pies cúbicos por minuto por pie cuadrado',
                'code' => '36',
            ],
            [
                'id' => 30,
                'name' => 'Onza por pie cuadrado',
                'code' => '37',
            ],
            [
                'id' => 31,
                'name' => 'Onzas por pie cuadrado por 0,01 pulgadas',
                'code' => '38',
            ],
            [
                'id' => 32,
                'name' => 'Mililitro por segundo',
                'code' => '40',
            ],
            [
                'id' => 33,
                'name' => 'Mililitro por minuto',
                'code' => '41',
            ],
            [
                'id' => 34,
                'name' => 'Bolsa súper a granel',
                'code' => '43',
            ],
            [
                'id' => 35,
                'name' => 'Bolsa a granel de quinientos kg',
                'code' => '44',
            ],
            [
                'id' => 36,
                'name' => 'Bolsa a granel de trescientos kg',
                'code' => '45',
            ],
            [
                'id' => 37,
                'name' => 'Bolsa a granel de cincuenta libras',
                'code' => '46',
            ],
            [
                'id' => 38,
                'name' => 'Bolsa de cincuenta libras',
                'code' => '47',
            ],
            [
                'id' => 39,
                'name' => 'Carga de automóviles a granel',
                'code' => '48',
            ],
            [
                'id' => 40,
                'name' => 'Kilogramos teóricos',
                'code' => '53',
            ],
            [
                'id' => 41,
                'name' => 'Sitas',
                'code' => '56',
            ],
            [
                'id' => 42,
                'name' => 'Malla',
                'code' => '57',
            ],
            [
                'id' => 43,
                'name' => 'Kilogramo neto',
                'code' => '58',
            ],
            [
                'id' => 44,
                'name' => 'Parte por millón',
                'code' => '59',
            ],
            [
                'id' => 45,
                'name' => 'Porcentaje de peso',
                'code' => '60',
            ],
            [
                'id' => 46,
                'name' => 'Parte por billón (us)',
                'code' => '61',
            ],
            [
                'id' => 47,
                'name' => 'Porcentaje por 1000 horas',
                'code' => '62',
            ],
            [
                'id' => 48,
                'name' => 'Tasa de fracaso en el tiempo',
                'code' => '63',
            ],
            [
                'id' => 49,
                'name' => 'Libra por pulgada cuadrada, calibre',
                'code' => '64',
            ],
            [
                'id' => 50,
                'name' => 'Oersted',
                'code' => '66',
            ]
        ];

        DB::table('unit_measurements')->insert($unitMeasurements);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('unit_measurements')->truncate();
    }
}
