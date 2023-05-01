<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddDocumentTypesCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $documentTypes = [
            [
                'id' => "f73f5793-795e-33db-9115-95437f9ecaea",
                'name' => 'CC',
                'description' => 'Cédula de ciudadanía'
            ],
            [
                'id' => "8cb0159c-d095-35ad-9cad-62e171c15dc8",
                'name' => 'CE',
                'description' => 'Cédula de extranjeria'
            ],
            [
                'id' => "80fc8d67-9a2b-3027-9eae-09db2d46dfd1",
                'name' => 'NIT',
                'description' => 'Número de identificación tributaria'
            ],
            [
                'id' => "ccffb71e-dbad-3400-ab3a-f261eaec8849",
                'name' => 'PA',
                'description' => 'Pasaporte'
            ],
        ];

        DB::table('document_types')->insert($documentTypes);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('document_types')->truncate();
    }
}
