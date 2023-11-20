<?php

namespace Arcplg\Smaregi\Features;


trait ApiCall
{

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function apiCall($data, $test = false)
    {

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $data['smaregiCallUri'],
                CURLOPT_HEADER => 0,
                CURLOPT_POSTFIELDS => $data['datas'] ?? http_build_query($data['queries']),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_CUSTOMREQUEST => $data['method'],
                CURLOPT_HTTPHEADER => $data['header']
            )
        );
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $responseData = [
            'data' => json_decode($response),
            'status_code' => $statusCode
        ];
        return $responseData;
    }
}