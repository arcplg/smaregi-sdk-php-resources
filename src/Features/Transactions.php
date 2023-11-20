<?php

namespace Arcplg\Smaregi\Features;


trait Transactions
{
    /**
     * 店舗一覧
     * @return mixed
     */
    public function getTransactions($datas)
    {
        $data = [
            'smaregiCallUri' => $this->getSmaregiCallUri('transactions') . $this->getURLQuery($datas),
            'queries' => [],
            'method' => config('smaregi.smaregi_method_get'),
            'header' => array(
                'Authorization:' . config('smaregi.smaregi_auth_token_type') . $this->getSmaregiAccessToken()
            )
        ];
        $responseData = $this->apiCall($data, false);
        $status_code = $responseData['status_code'] ?? null;
        $response = $responseData['data'] ?? null;
        if ($status_code == 200) {
            return $response;
        } else {
            return $response;
        }
    }

    /**
     * 一個取引
     * @return mixed
     */
    public function getTransaction($transaction_id, $values = null)
    {
        $params = $values ?? null;

        if ($values != null) {
            $params = '?' . http_build_query($values);
        }
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['transactions'] . $transaction_id . $params,
            'queries' => [],
            'method' => config('smaregi.smaregi_method_get'),
            'header' => array(
                'Authorization:' . config('smaregi.smaregi_auth_token_type') . $this->getSmaregiAccessToken()
            )
        ];
        $responseData = $this->apiCall($data, false);
        $status_code = $responseData['status_code'] ?? null;
        $response = $responseData['data'] ?? null;
        if ($status_code == 200) {
            return $response;
        } else {
            return $response;
        }
    }
    /**
     * 一個取引
     * @return mixed
     */
    public function getTransactionDetails($transaction_id, $values)
    {
        $params = $values ?? null;

        if ($values != null) {
            $params = '?' . http_build_query($values);
        }
        $data = [
            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['transactions'] . $transaction_id . '/details' . $params,
            'queries' => $values ?? [],
            'method' => config('smaregi.smaregi_method_get'),
            'header' => array(
                'Authorization:' . config('smaregi.smaregi_auth_token_type') . $this->getSmaregiAccessToken()
            )
        ];
        $responseData = $this->apiCall($data, false);
        $status_code = $responseData['status_code'] ?? null;
        $response = $responseData['data'] ?? null;
        if ($status_code == 200) {
            return $response;
        } else {
            return $response;
        }
    }
    /**
     * 取引取得
     * @return mixed
     */
    public function createTransaction($datas)
    {
        $data = [
            'smaregiCallUri' => $this->getSmaregiCallUri('transactions'),
            'queries' => [],
            'datas' => json_encode($datas),
            'method' => config('smaregi.smaregi_method_post'),
            'header' => array(
                'Authorization:' . config('smaregi.smaregi_auth_token_type') . $this->getSmaregiAccessToken()
            )
        ];
        $responseData = $this->apiCall($data, false);
        $status_code = $responseData['status_code'] ?? null;
        $response = $responseData['data'] ?? null;
        if ($status_code == 200) {
            return $response;
        } else {
            return $response;
        }
    }

    /**
     * 取引更新
     *
     * @param [type] $id
     * @param [type] $datas
     * @return mixed
     */
    public function updateTransaction($id, $datas)
    {
        $data = [

            'smaregiCallUri' => $this->getSmaregiCallUri('transactions') . $id,
            'queries' => [],
            'datas' => json_encode($datas),
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
     * 取引取消
     *
     * @param [type] $id
     * @param [type] $datas
     * @return mixed
     */
    public function cancelTransaction($id, $datas)
    {
        $data = [

            'smaregiCallUri' => $this->getSmaregiCallUri('transactions') . $id . '/cancel',
            'queries' => [],
            'datas' => json_encode($datas),
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
}