<?php

namespace Arcplg\Smaregi\Features;

use Exception;

trait Products
{


    /**
     * 製品一覧
     * @return mixed
     */
    public function getProductsList($query=[])
    {

        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['products'],
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

    /**
     * 製品一括登録
     * @param mixed $values
     *
     * @return mixed
     */
    public function createBulkProducts($values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['products'] . 'bulk',
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

    /**
     *  製品編集
     * 
     * @param mixed $values
     *
     * @return mixed
     */
    public function updateProduct($id, $values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['products'] . $id,
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
     *  製品一括更新
     * @param mixed $values
     *
     * @return mixed
     */
    public function updateBulkProducts($values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['products'] . 'bulk',
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
     *  製品削除
     * @param mixed $id
     * 
     * @return mixed
     */
    public function deleteProduct($id)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['products'] . $id,
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
     *  製品登録または更新
     * @param mixed $id
     * 
     * @return mixed
     */

    public function createOrUpdateProduct($value)
    {
        $category = $this->getCategoriesByCategoryCode($value['categoryCode']);
        $value['categoryId'] = $category->categoryId;
        unset($value['categoryCode']);

        $query = ['product_code' => $value['productCode']];
        $productList = $this->getProductsList($query);

        if ($productList) {
            return $this->updateProduct($productList[0]->productId, $value);
        } else {
            return $this->createProduct($value);
        }
    }
}
