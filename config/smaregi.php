<?php

return [
    /*
    |--------------------------------------------------------------------------
    | smaregi  contract id
    |--------------------------------------------------------------------------
    */

    'smaregi_contract_id' => env('SMAREGI_CONTRACT_ID', 'AAAAAAA'),
    /*
    |--------------------------------------------------------------------------
    | smaregi  access
    |--------------------------------------------------------------------------
    */

    'smaregi_access' => [
        'pos.products:read',
        'pos.products:write',
        'pos.customers:read',
        'pos.customers:write',
        'pos.stock:read',
        'pos.stock:write',
        'pos.stock-changes:read',
        'pos.transactions:read',
        'pos.transactions:write',
        'pos.suppliers:read',
        'pos.suppliers:write',
        'pos.stores:read',
        'pos.stores:write',
        'pos.staffs:read',
        'pos.staffs:write',
        'pos.losses:read',
        'pos.losses:write',
        'pos.orders:read',
        'pos.orders:write',
        'pos.transfers:read',
        'pos.transfers:write',
        'pos.stocktaking:read',
        'order-shipment.stores:read',
        'order-shipment.stores:write',
        'order-shipment.orders:read',
        'order-shipment.orders:write',
        'order-shipment.stock:read'
    ],

    /*
    |--------------------------------------------------------------------------
    |  smaregi app client id and paste here
    |--------------------------------------------------------------------------
    */

    'smaregi_app_client_id' => env('SMAREGI_APP_CLIENT_ID', 'BBBBBBBB'),

    /*
    |--------------------------------------------------------------------------
    | smaregi  app client secret
    |--------------------------------------------------------------------------
    */
    'smaregi_app_client_secret' => env('SMAREGI_APP_CLIENT_SECRET', 'CCCCCCCCCCC'),


    /*
    |--------------------------------------------------------------------------
    | smaregi  base api url
    |--------------------------------------------------------------------------
    */

    'smaregi_base_api_url' => env('SMAREGI_BASE_API_URL', 'https://api.smaregi.jp/'),

    /*
    |--------------------------------------------------------------------------
    | smaregi auth  base api url
    |--------------------------------------------------------------------------
    */

    'smaregi_base_auth_api_url' => env('SMAREGI_BASE_AUTH_API_URL', 'https://id.smaregi.jp/app/'),

    /*
    |--------------------------------------------------------------------------
    | smaregi content type
    |--------------------------------------------------------------------------
    */
    'smaregi_content_type' => 'application/x-www-form-urlencoded',

    /*
    |--------------------------------------------------------------------------
    | smaregi  grant type
    |--------------------------------------------------------------------------
    */

    'smaregi_grant_type' => 'client_credentials',

    /*
    |--------------------------------------------------------------------------
    | smaregi  auth token type
    |--------------------------------------------------------------------------
    */
    'smaregi_auth_token_type' => env('SMAREGI_AUTH_TOKEN_TYPE', 'Bearer '),



    /*
    |--------------------------------------------------------------------------
    | smaregi  post method
    |--------------------------------------------------------------------------
    */
    'smaregi_method_post' => env('SMAREGI_METHOD_POST', 'POST'),


    /*
    |--------------------------------------------------------------------------
    | smaregi  get method
    |--------------------------------------------------------------------------
    */
    'smaregi_method_get' => env('SMAREGI_METHOD_GET', 'GET'),

    /*
    |--------------------------------------------------------------------------
    | smaregi  patch method
    |--------------------------------------------------------------------------
    */
    'smaregi_method_patch' => env('SMAREGI_METHOD_PATCH', 'PATCH'),

    /*
    |--------------------------------------------------------------------------
    | smaregi  delete method
    |--------------------------------------------------------------------------
    */
    'smaregi_method_delete' => env('SMAREGI_METHOD_DELETE', 'DELETE'),


    /*
    |--------------------------------------------------------------------------
    | smaregi  covered API
    |--------------------------------------------------------------------------
    */
    'smaregi_api_list' => [
        'shops' => '/pos/stores/',
        'stocks' => '/pos/stock/',
        'transactions' => '/pos/transactions/',
        'products' => '/pos/products/',
        'adjustments' => '/pos/adjustments/',
        'daily_summaries' => '/pos/daily_summaries/'
    ],
];