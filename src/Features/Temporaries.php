<?php

namespace Arcplg\Smaregi\Features;

trait Temporaries
{
    /**
     * 仮販売登録
     * @return mixed
     */
    public function createTemporaryTransaction($values)
    {
        $data = [

            'smaregiCallUri' => config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')['temporaries'],
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
}
