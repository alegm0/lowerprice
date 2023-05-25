<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddCategoriesCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $category = [
            [
                'id' => 1,
                'identifier' => 'MCO1747',
                'name' => 'Accesorios para Vehículos'
            ],
            [
                'id' => 2,
                'identifier' => 'MCO441917',
                'name' => 'Agro'
            ],
            [
                'id' => 3,
                'identifier' => 'MCO1403',
                'name' => 'Alimentos y Bebidas'
            ],
            [
                'id' => 4,
                'identifier' => 'MCO1071',
                'name' => 'Animales y Mascotas'
            ],
            [
                'id' => 5,
                'identifier' => 'MCO1367',
                'name' => 'Antigüedades y Colecciones'
            ],
            [
                'id' => 6,
                'identifier' => 'MCO1368',
                'name' => 'Arte, Papelería y Mercería'
            ],
            [
                'id' => 7,
                'identifier' => 'MCO1384',
                'name' => 'Bebés'
            ],
            [
                'id' => 8,
                'identifier' => 'MCO1246',
                'name' => 'Belleza y Cuidado Personal'
            ],
            [
                'id' => 9,
                'identifier' => 'MCO40433',
                'name' => 'Boletas para Espectáculos'
            ],
            [
                'id' => 10,
                'identifier' => 'MCO1039',
                'name' => 'Cámaras y Accesorios'
            ],
            [
                'id' => 11,
                'identifier' => 'MCO1743',
                'name' => 'Carros, Motos y Otros'
            ],
            [
                'id' => 12,
                'identifier' => 'MCO1051',
                'name' => 'Celulares y Teléfonos'
            ],
            [
                'id' => 13,
                'identifier' => 'MCO1648',
                'name' => 'Computación'
            ],
            [
                'id' => 14,
                'identifier' => 'MCO1144',
                'name' => 'Consolas y Videojuegos'
            ],
            [
                'id' => 15,
                'identifier' => 'MCO172890',
                'name' => 'Construcción'
            ],
            [
                'id' => 16,
                'identifier' => 'MCO1276',
                'name' => 'Deportes y Fitness'
            ],
            [
                'id' => 17,
                'identifier' => 'MCO5726',
                'name' => 'Electrodomésticos'
            ],
            [
                'id' => 18,
                'identifier' => 'MCO1000',
                'name' => 'Electrónica, Audio y Video'
            ],
            [
                'id' => 19,
                'identifier' => 'MCO175794',
                'name' => 'Herramientas'
            ],
            [
                'id' => 20,
                'identifier' => 'MCO1574',
                'name' => 'Hogar y Muebles'
            ],
            [
                'id' => 21,
                'identifier' => 'MCO1499',
                'name' => 'Industrias y Oficinas'
            ],
            [
                'id' => 22,
                'identifier' => 'MCO1459',
                'name' => 'Inmuebles'
            ],
            [
                'id' => 23,
                'identifier' => 'MCO1182',
                'name' => 'Instrumentos Musicales'
            ],
            [
                'id' => 24,
                'identifier' => 'MCO1132',
                'name' => 'Juegos y Juguetes'
            ],
            [
                'id' => 25,
                'identifier' => 'MCO3025',
                'name' => 'Libros, Revistas y Comics'
            ],
            [
                'id' => 26,
                'identifier' => 'MCO1168',
                'name' => 'Música, Películas y Series'
            ],
            [
                'id' => 27,
                'identifier' => 'MCO118204',
                'name' => 'Recuerdos, Piñatería y Fiestas'
            ],
            [
                'id' => 28,
                'identifier' => 'MCO3937',
                'name' => 'Relojes y Joyas'
            ],
            [
                'id' => 29,
                'identifier' => 'MCO1430',
                'name' => 'Ropa y Accesorios'
            ],
            [
                'id' => 30,
                'identifier' => 'MCO180800',
                'name' => 'Salud y Equipamiento Médico'
            ],
            [
                'id' => 31,
                'identifier' => 'MCO1540',
                'name' => 'Servicios'
            ],
            [
                'id' => 32,
                'identifier' => 'MCO1953',
                'name' => 'Otras categorías'
            ]
        ];

        DB::table('categories')->insert($category);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
