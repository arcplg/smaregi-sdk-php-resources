# Smaregi Php `composer` SDK

## Overview
The Sdk for php(Laravel) Project.

## installation 

 run the following command on your existing laravel project 

 <!-- `composer require arcplg/smaregi`  -->

 ## Vendor publish
 publish the config file by running following command 
 <!-- `php artisan vendor:publish ` -->
 
 ## Setup

### Contract Id
    'smaregi_contract_id' => env('SMAREGI_CONTRACT_ID', 'aaaaaaaa'),
copy your contract ID from smaregi admin panel and paste at `aaaaaaaa`

### Client Id
    'smaregi_app_client_id' => env('SMAREGI_APP_CLIENT_ID', 'bbbbbbbb'),

copy your app client id from smaregi app setting and paste at `bbbbbbbb`

### App Secret

    'smaregi_app_client_secret' => env('SMAREGI_APP_CLIENT_SECRET', 'cccccccc'),
copy your app secret from smaregi app setting and paste at `cccccccc`

### Auth Url 
    'smaregi_base_auth_api_url' => env('SMAREGI_BASE_AUTH_API_URL', 'https://id.smaregi.dev/app/'),

change the Url to Production environment

### API base Url
    'smaregi_base_api_url' => env('SMAREGI_BASE_API_URL', 'https://api.smaregi.dev/'),

change the Url to Production environment

## Apis 
Supported API list
### products
1. list
2. create
3. update
4. bulk create
5. bulk update
6. delete