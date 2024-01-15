<?php

namespace Arcplg\Smaregi\Features;


trait DailySummaries
{
    /**
     * 店舗一覧
     * @return mixed
     */
    public function getDailySummaries($datas)
    {
        $data = [
            'smaregiCallUri' => $this->getSmaregiCallUri('daily_summaries') . $this->getURLQuery($datas),
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

}