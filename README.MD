# スマレジのSDKのインストール方法
プロジェクトのcomposer.jsonファイルのrepositoryに以下の内容を追加します。

```
    {
        "url": "https://github.com/arcplg/smaregi-sdk-php-resources.git",
        "type": "git"
    }

```

次に以下のコマンドを実行します。

```
 composer require arcplg/smaregi:dev-master 
 ```

その後vendor publishするために以下のコマンドを実行します。

```
 php artisan vendor:publish --tag=arcplg-smaregi-config 
 ```

このコマンドを実行すると、プロジェクトの```config```ディレクトリに```smaregi.php```ファイルが生成されます。  
Smaregiの開発者アカウントから必要な項目をコピーし、以下のように貼り付けます。

```
 'smaregi_contract_id' => env('SMAREGI_CONTRACT_ID', 'AAAAAAA'),
 'smaregi_app_client_id' => env('SMAREGI_APP_CLIENT_ID', 'BBBBBBBB'),
 'smaregi_app_client_secret' => env('SMAREGI_APP_CLIENT_SECRET', 'CCCCCCCCCCC'),

```
```AAAAAAA```,```BBBBBBBB```,```CCCCCCCCCCC```に自分のデベロッパアカウント情報を貼り付けます

または.envが有効な場合は環境変数を追加してもOKです。

```
SMAREGI_CONTRACT_ID=AAAAAAA
SMAREGI_APP_CLIENT_ID=BBBBBBBB
SMAREGI_APP_CLIENT_SECRET=CCCCCCCCCCC
SMAREGI_UPDATE_BULK_PRODUCTS_CALLBACK_URL=https://your.api.callback.com/
```



## 使い方
ControllerでSmaregiパッケージを使用します。

```
use Arcplg\Smaregi\Smaregi;
```

#### 関数呼び出し

```
$smaregi = new Smaregi();
return $smaregi->deleteShop($id);
```

#### 値を持つ関数
```
 $values = [
        'categoryId' => 8000001,
        'productName' => 'test product',
        'price' => 12300
    ],

    $smaregi = new Smaregi();
    $smaregi->createProduct($values);
```


# テスト

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
2. 部門
    1. 一覧
    2. 作成
    3. 削除
    4. 更新
    5. 登録または更新
3. 店舗
    1. 一覧
    2. 作成
    3. 削除
    4. 更新
    5. 店舗詳細
4. 在庫
    1. 一覧
    2. 更新
    3. 一括更新
5. 取引
    1. 一覧
    2. 詳細
    3. 取消
    4. 更新
    5. 作成
6. レジ端末
    1. 一覧
7. 日次締め情報
    1. 一覧

# SDKのフォルダ構成

1. config
2. src

### 1. config

configフォルダには`smaregi.php`という設定ファイルが含まれています。このファイルには各種設定を記述します。  
他のプロジェクトで`composer install`を実行し、その後`php artisan vendor publish`を実行すると、このファイルはLaravelのconfigフォルダに自動的にコピーされます。

`smaregi.php`ファイルの最後にある`smaregi_api_list`キーは、現在SDKが対応しているAPIのリストを示しています。

### 2. src

srcフォルダには実際のコードが格納されています。`SmaRegiBaseServiceProvider.php`は設定を記述する場所で、`vendor publish`を実行したときにconfigファイルをどこに配置するかなどを設定します。

`Smaregi.php`ファイルはグローバル関数を記述しているファイルで、SDKのエントリーポイント（メインファイル）です。

### src/Features 

`Features`フォルダには各APIのロジックが記述されています。

Featuresフォルダに新しい機能を追加した場合、`Smaregi.php`ファイルでそのファイルをuseする必要があります。

#### 例

`Features/products.php`を追加した場合、以下のように記述します。

```php
use Arcplg\Smaregi\Features\Products;
use Products;
```

Features/ApiCall.phpは各APIからSmaregiまでの呼び出しを行うファイルです。

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

上記の関数は店舗の一覧を取得する関数です。
`$data`は`config`ファイルの設定項目や`queries`などが格納された変数です。
`$this->apiCall($data);` はApiCall.phpの関数を呼び出しています。
上記の関数はクエリがない場合のものです。以下にクエリがある場合の例を示します。

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

クエリがある場合は、クエリパラメータにする必要があります。そのため、apiCall関数に以下の行を追加しています。

`CURLOPT_POSTFIELDS => $data['datas'] ?? http_build_query($data['queries']),`

作成や編集の場合はクエリは不要ですが、Valuesが必要となります。その場合は、

`queries`を空の配列にし、`datas`に`values`を設定します。

`Smaregi`では`Values`は常に`json`形式である必要があります。そのため、`json_encode`を使用して`values`を`datas`に設定します。

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
