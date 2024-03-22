<?php

namespace Arcplg\Smaregi\Features;

trait Categories
{
    /**
     * 部門一覧
     * @return mixed
     */
    public function getCategories()
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['categories'],
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
     * 部門コードより部門取得
     * @return mixed
     */
    public function getCategoriesByCategoryCode($categoryCode)
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['categories'] ,
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
            foreach ($response as $category) {
                if ($category->categoryCode == $categoryCode) {
                    return $category;
                }
            }
        } else {
            return [];
        }
    }

    /**
     * 部門登録
     * @return mixed
     */
    public function createCategory($values)
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['categories'],
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
     * 部門取得
     * @return mixed
     */
    public function getCategory($category_id)
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['categories'] . $category_id,
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
    public function updateCategory($id, $values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['categories'] . $id,
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
     *  部門削除
     * @param mixed $id
     * 
     * @return mixed
     */
    public function deleteCategory($id)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['categories'] . $id,
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
     *  部門登録、または更新
     * 
     * @param mixed $values
     *
     * @return mixed
     */
    // categoryCodeで検索して存在したらupdate、存在しなかったらcreate
    public function createOrUpdateCategory($values)
    {
        // print_r("***********");
        // print_r($values['categoryCode']);
        $category = $this->getCategoriesByCategoryCode($values['categoryCode']);
        // print_r($category);
        if ($category) {
            return $this->updateCategory($category->categoryId, $values);
        } else {
            return $this->createCategory($values);
        }
    }
}