<?php

namespace Arcplg\Smaregi\Features;


trait Shops
{

    /**
     * 店舗一覧
     * @return mixed
     */
    public function getShops($query = [])
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['shops'],
            'queries' => $query,
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

    /**
     * 店舗登録
     * @return mixed
     */
    public function createShop($values)
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['shops'],
            'queries' => [],
            'datas' => json_encode($values),
            'method' => config('smaregi.smaregi_method_post'),
            'header' => array(
                'Content-Type: application/json',
                'Authorization:' . config('smaregi.smaregi_auth_token_type') . $this->getSmaregiAccessToken()
            )
        ];
        $responseData = $this->apiCall($data, false);
        $status_code = $responseData['status_code'] ?? null;
        $response = $responseData;
        if ($status_code == 200) {
            return $response;
        } else {
            return $response;
        }
    }

    /**
     * 店舗一覧
     * @return mixed
     */
    public function getShop($shop_id)
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['shops'] . $shop_id,
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

    /**
     *  製品編集
     * 
     * @param mixed $values
     *
     * @return mixed
     */
    public function updateShop($id, $values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['shops'] . $id,
            'queries' => [],
            'datas' => json_encode($values),
            'method' => config('smaregi.smaregi_method_patch'),
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

    /**
     *  店舗削除
     * @param mixed $id
     * 
     * @return mixed
     */
    public function deleteShop($id)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['shops'] . $id,
            'queries' => [],
            'method' => config('smaregi.smaregi_method_delete'),
            'header' => array(
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

    /**
     *  店舗登録または更新
     * @param mixed $id
     * 
     * @return mixed
     */

     public function createOrUpdateShop($value)
     {
        
        $query = ['store_code' => $value['storeCode']];
        $shopList = $this->getShops($query);
        print_r($shopList);

        if ($shopList) {
            return $this->updateShop($shopList[0]->storeId, $value);
        } else {
            return $this->createShop($value);
        }
     }

}