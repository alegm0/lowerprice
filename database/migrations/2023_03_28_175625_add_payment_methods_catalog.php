<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddPaymentMethodsCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $paymentMethods = [
            [
                'id' => 1,
                'code' => '10',
                'name' => 'Efectivo',
                'description' => 'Efectivo',
            ],
            [
                'id' => 2,
                'code' => '49',
                'name' => 'Tarjeta Débito',
                'description' => 'Tarjeta Débito',
            ],
            [
                'id' => 3,
                'code' => '42',
                'name' => 'Consignación bancaria',
                'description' => 'Consignación bancaria',
            ],
            [
                'id' => 4,
                'code' => '95',
                'name' => 'Giro formato abierto',
                'description' => 'Giro formato abierto',
            ],
            [
                'id' => 5,
                'code' => '48',
                'name' => 'Tarjeta Crédito',
                'description' => 'Tarjeta Crédito',
            ],
            [
                'id' => 6,
                'code' => '47',
                'name' => 'Transferencia Débito Bancaria',
                'description' => 'Transferencia Débito Bancaria',
            ],
            [
                'id' => 7,
                'code' => '20',
                'name' => 'Cheque',
                'description' => 'Cheque',
            ],
            [
                'id' => 8,
                'code' => '71',
                'name' => 'Bonos',
                'description' => 'Bonos',
            ],
            [
                'id' => 9,
                'code' => '72',
                'name' => 'Vales',
                'description' => 'Vales',
            ],
            [
                'id' => 10,
                'code' => '45',
                'name' => 'Transferencia Crédito Bancario',
                'description' => 'Transferencia Crédito Bancario',
            ]
        ];

        DB::table('payment_methods')->insert($paymentMethods);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('payment_methods')->truncate();
    }
}
