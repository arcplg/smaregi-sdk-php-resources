# スマレージのSDKインストルー方法
プロジェクトのcomposer.jsonファイルのrepositoryに下記のもの貼り付けます

```
    {
        "url": "https://github.com/arcplg/smaregi-sdk-php-resources.git",
        "type": "git"
    }

```
そのご下記のコマンド実行する
```
 composer require arcplg/smaregi:dev-master 
 ```

その後vendor publishするため下記のコマンド実行
```
 php artisan vendor:publish --tag=arcplg-smaregi-config 
 ```
その実行後はプロジェクトの```config```ディレクトリの中```smaregi.php```ファイルができます　Smaregiのデベロッパアカウントから必要な項目コピーしてもらって貼り付けます
```
 'smaregi_contract_id' => env('SMAREGI_CONTRACT_ID', 'AAAAAAA'),
 'smaregi_app_client_id' => env('SMAREGI_APP_CLIENT_ID', 'BBBBBBBB'),
 'smaregi_app_client_secret' => env('SMAREGI_APP_CLIENT_SECRET', 'CCCCCCCCCCC'),

```
```AAAAAAA```,```BBBBBBBB```,```CCCCCCCCCCC```に自分のデベロッパアカウント情報を貼り付けます

## 使い方
ControllerにSmaregi PackageをUse
```
use Arcplg\Smaregi\Smaregi;
```
#### 関数呼び出し
```
$smaregi = new Smaregi();
return $smaregi->deleteShop($id);
```
#### Valuesあり関数
```
 $values = [
        'categoryId' => 8000001,
        'productName' => 'test product',
        'price' => 12300
    ],

    $smaregi = new Smaregi();
    $smaregi->createProduct($values);
```

## Testing
 SDKのphp UNITテスト行いたい場合は

このgitをcloneしてください

 ``` feature/test```ブランチに切り替えてくだださい

```composer install``` してください
 
 その後下記のコマンド実行

 ```
 composer global require phpunit/phpunit
 ```
```test/Feature```全てテストしたい場合は　下記のコマンド実行してください
```
phpunit
```
定義した関数だけテストしたい場合は下記のコマンド実行してください
```
phpunit --filter testAuthorizationTokenType
```


## 対応済API
1. 製品
    1. 一覧
    2. 作成
    3. 削除
    4. 更新
    5. 一括作成
    6. 一括更新
2. 店舗
    1. 一覧
    2. 作成
    3. 削除
    4. 更新
    6. 店舗詳細
3. 在庫
    1. 一覧
    4. 更新
    6. 一括更新
4. 取引
    1. 一覧
    2. 詳細
    3. 取消
    4. 更新
    5. 作成
5. レジ端末
    1. 一覧
6. 日次締め情報
    1. 一覧

# SDKのフォルダい一覧

1. config
2. src

### 1. config

1. config

configフォルダの中身は`smaregi.php`　ファイルがありますそちらには設定を書きます他のプロジェクトで`composer` で`install`したて　`php artisan vendor publish` したときlaravel

中のconfigフォルーだに自動的に入るファイルです.

smaregi.phpファイルの中の一番下にあるkey　`smaregi_api_list`　は現在SDKで対応されていAPIリストです

### 2. src

srcは実際のコードあるフォルダですsrcの中の`SmaRegiBaseServiceProvider.php` は設定かくところですvendor publishしたときconfigファイルをどこに置きますなどのせていかくファイルです.

`Smaregi.php` ファイルはGlobal関数書いているファイルですこれはSDKのエントリー(メイン)ファイルです。


### src/Features 

`Features`はかくAPIのロジック書いているフォルダです。

Featuresの中に新しい機能などの追加あったら```Smaregi.php```にそのファイルをUseする必要あります
#### 例

```Features/products.php```の場合は下記のように書く必要あります

```use Arcplg\Smaregi\Features\Products;```

```use Products;```


`Features/ApiCall.php` はかくAPIから```Smaregi```までcallするファイルです

### 例

`shops.php`

```php
/**
     * 店舗一覧
     * @return mixed
     */
    public function getShops()
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['shops'],
            'queries' => [],
            'method' => config('smaregi.smaregi_method_get'),
            'header' => array(
                'Authorization:' . config('smaregi.smaregi_auth_token_type') . $this->getSmaregiAccessToken()
            )
        ];
        $responseData = $this->apiCall($data);
        $status_code = $responseData['status_code'] ?? null;
        $response = $responseData['data'] ?? null;
        if ($status_code == 200) {
            return $response;
        } else {
            return $response;
        }
    }
```

上の関数は店舗の一覧取る関数です

`$data`には`config`ファイルの設定項目と`querries`などを入ってある変数です

`$this->apiCall($data);` これはApiCall.phpの関数を呼ぶだしています。

上の関数にはQuerryなしのものです下記の場合はQuerryある例です

### 例

`Authorization.php`

```php
public function login($where = null)
    {
        

        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_auth_api_url') . config('smaregi.smaregi_contract_id') . '/token',
            'queries' => [
                'grant_type' => config('smaregi.smaregi_grant_type'),
                'scope' => $this->scope
            ],
            'method' => config('smaregi.smaregi_method_post'),
            'header' => array(
                'Authorization: Basic ' . $this->getBasicToken(),
                'Content-Type:' . config('smaregi.smaregi_content_type'),
            )
        ];

        $responseData = $this->apiCall($data);

        $response = $responseData['data'] ?? null;
        $status_code = $responseData['status_code'] ?? null;
        $response->status_code = $status_code;
        if ($status_code == 200) {
            if ($where == 'set') {
                return $response;
            } else {
                $this->setSmaregiAccessToken($response->access_token);
                return $response;
            }
        } else {
            return $response;
        }
    }
```

querriesある場合はquerry parameterにする必要ありますのでapiCall関数に下記のぎょう追加してあります

`CURLOPT_POSTFIELDS => $data['datas'] ?? http_build_query($data['queries']),`

作成とか編集の場合はquerryいらないですがValuesが必要ですその場合は

`querries`を空の配列にして`datas`に`values`を設定します

`Smaregi`では`Values`はいつも`json`にする必要ありますので`json_encode`して`datas`に`values`を設定します。

### 例

`products.php`

```php
/**
     * 製品登録
     * @param mixed $values
     *
     * @return mixed
     */
    public function createProduct($values)
    {

        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['products'],
            'queries' => [],
            'datas' => json_encode($values),
            'method' => config('smaregi.smaregi_method_post'),
            'header' => array(
                'Content-Type: application/json',
                'Authorization:' . config('smaregi.smaregi_auth_token_type') . $this->getSmaregiAccessToken()
            )
        ];
        $responseData = $this->apiCall($data);
        $status_code = $responseData['status_code'] ?? null;
        $response = $responseData;
        if ($status_code == 200) {
            return $response;
        } else {
            return $response;
        }
    }
```
