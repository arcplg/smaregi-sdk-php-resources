<?php

namespace Arcplg\Smaregi\Features;


trait PaymentMethodGroups
{

    /**
     * 支払方法一覧
     * @return mixed
     */
    public function getPaymentMethodGroups($query = [])
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['payment_method_groups'],
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
     * 支払方法登録
     * @return mixed
     */
    public function createPaymentMethodGroup($values)
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['payment_method_groups'],
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
     * 支払方法一覧
     * @return mixed
     */
    public function getPaymentMethodGroup($payment_method_group_id)
    {
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['payment_method_groups'] . $payment_method_group_id,
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
    public function updatePaymentMethodGroup($id, $values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['payment_method_groups'] . $id,
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
     *  支払方法削除
     * @param mixed $id
     * 
     * @return mixed
     */
    public function deletePaymentMethodGroup($id)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['payment_method_groups'] . $id,
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
     *  支払方法登録または更新
     * @param mixed $id
     * 
     * @return mixed
     */

     public function createOrUpdatePaymentMethodGroup($value)
     {
        
        $paymentMethodGroupList = $this->getPaymentMethodGroups();
        $skip = 0;
        foreach ($paymentMethodGroupList as $key2 => $val2) {
            if ($value['name'] == $val2->name) {
                $skip = 1;
            }
        }
        if ($skip == 0) {
            $create = $this->createPaymentMethodGroup($value);
            print_r($create);
            return $create;
        }
     }

}