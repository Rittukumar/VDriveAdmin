<?php

class PaymentModeTableSeeder extends Seeder
{

    public function run()
    {
        PaymentMode::create([
            'title' => 'Cash On Delivery'
        ]);

        PaymentMode::create([
            'title' => 'Bank Payment'
        ]);

        PaymentMode::create([
            'title' => 'Cheque Payment'
        ]);

        PaymentMode::create([
            'title' => 'Pay Online'
        ]);

        PaymentMode::create([
            'title' => 'PayU Money'
        ]);

    }

}