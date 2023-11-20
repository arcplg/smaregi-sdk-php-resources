<?php

namespace Arcplg\Smaregi\Features;

/**
 * 在庫トレイト
 */
trait Stocks
{
    /**
     *  在庫取得
     * @return mixed
     */
    public function getStock()
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['stocks'],
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
     * 在庫更新
     * @return [type]
     */
    public function updateStock($product_id, $values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['stocks'] . $product_id,
            'queries' => [],
            'datas' => json_encode($values),
            'method' => config('smaregi.smaregi_method_patch'),
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
     * 在庫更新
     * @return [type]
     */
    public function updateBulkStock($values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['stocks'] . 'bulk',
            'queries' => [],
            'datas' => json_encode($values),
            'method' => config('smaregi.smaregi_method_patch'),
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
}