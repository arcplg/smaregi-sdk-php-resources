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
