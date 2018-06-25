<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Cart database settings
    |--------------------------------------------------------------------------
    |
    | Here you can set the connection that the Laravel Cart should use when
    | storing and restoring a cart.
    |
    */

    'database' => [

        'connection' => null,

        'table' => 'carts'
    ],

    /*
    |--------------------------------------------------------------------------
    | Update the cart on user login
    |--------------------------------------------------------------------------
    |
    | When this option is set to 'true' the cart will automatically
    | update the session cart from the cart on the database
    |
    */

    'update_on_login' => true,

    /*
    |--------------------------------------------------------------------------
    | Cart lines
    |--------------------------------------------------------------------------
    |
    | When this option is set to 'true' the cart will automatically
    | update the session cart from the cart on the database
    |
    */

    'lines' => [
        'taxes' => function($total, $subtotal, $items) {
            return $subtotal * 0.15;
        }
    ]

];