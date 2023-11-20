<?php

namespace Arcplg\Smaregi\Features;


trait Authorization
{

    /**
     * user login function function
     *
     * @return mixed
     */
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
}