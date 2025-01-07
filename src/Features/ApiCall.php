<?php

namespace Arcplg\Smaregi\Features;


trait ApiCall
{

    /**
     * @param mixed $data
     *
     * @return mixed
     * @throws \Exception
     */
    public function apiCall($data, $test = false)
    {

        $curl = curl_init();
        try {
            if ($data['method'] === 'GET' && isset($data['queries'])) {
                $separator = (parse_url($data['smaregiCallUri'], PHP_URL_QUERY) == null) ? '?' : '&';
                $data['smaregiCallUri'] .= $separator . http_build_query($data['queries']);
            }
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $data['smaregiCallUri'],
                    CURLOPT_HEADER => 0,
                    CURLOPT_POSTFIELDS => $data['datas'] ?? http_build_query($data['queries']),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FRESH_CONNECT => true,
                    CURLOPT_CUSTOMREQUEST => $data['method'],
                    CURLOPT_HTTPHEADER => $data['header'],
                    )
            );

            $response = curl_exec($curl);
            if ($response === false) {
                throw new \Exception('cURL error: ' . curl_error($curl));
            }

            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $responseData = [
                'data' => json_decode($response, true),
                'status_code' => $statusCode,
            ];
        } catch (\Exception $e) {
            // Log or handle the exception
            throw new \Exception('Error in API call: ' . $e->getMessage());
        } finally {
            curl_close($curl);
        }

        return $responseData;
    }
}
