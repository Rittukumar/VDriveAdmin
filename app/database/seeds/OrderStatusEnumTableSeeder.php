<?php

class OrderStatusEnumTableSeeder extends Seeder
{

    public function run()
    {
        OrderStatusEnum::create([
            'status' => 'Placed'
        ]);

        OrderStatusEnum::create([
            'status' => 'Received'
        ]);

        OrderStatusEnum::create([
            'status' => 'Shipped'
        ]);

        OrderStatusEnum::create([
            'status' => 'Delivered'
        ]);

        OrderStatusEnum::create([
            'status' => 'Returned'
        ]);

        OrderStatusEnum::create([
            'status' => 'Cancelled'
        ]);
    }

}