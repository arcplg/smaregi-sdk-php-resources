<?php

namespace Arcplg\Smaregi;

use Arcplg\Smaregi\Features\Shops;
use Arcplg\Smaregi\Features\Stocks;
use Arcplg\Smaregi\Features\ApiCall;
use Arcplg\Smaregi\Features\Products;
use Arcplg\Smaregi\Features\Temporaries;
use Arcplg\Smaregi\Features\Transactions;
use Arcplg\Smaregi\Features\Adjustments;
use Arcplg\Smaregi\Features\Authorization;
use Arcplg\Smaregi\Features\DailySummaries;
use Arcplg\Smaregi\Features\Terminals;
use Arcplg\Smaregi\Features\Categories;

class Smaregi
{
    use ApiCall, Authorization, Shops, Products, Stocks, Transactions, Adjustments, DailySummaries, Terminals, Temporaries, Categories;

    /**
     * @var mixed
     */
    protected $scope;
    protected $features = [];

    /**
     * @var mixed
     */
    protected $data;



    /**
     * @var mixed
     */
    protected $smaregi_access_token;

    /**
     * initialise the content
     *
     * @param mixed $scope
     */
    public function __construct($scope = null)
    {
        $this->scope = $scope;
        $this->getScope();
        $this->getBasicToken();
        $this->setSmaregiAccessToken();
        $this->getSmaregiAccessToken();
        $this->getSmaregiCallUri('token');
    }

    /**
     * @return mixed
     */
    public function getScope()
    {

        if (is_null($this->scope)) {
            return $this->scope = implode(' ', config("smaregi.smaregi_access"));
        } else if (is_array($this->scope)) {
            $scopes = implode(' ', $this->scope);
            return $this->scope = $scopes;
        } else if (is_string($this->scope)) {
            return $this->scope;
        }
    }


    /**
     * @return mixed
     */
    public function getBasicToken()
    {
        $clientId = config('smaregi.smaregi_app_client_id');
        $clientSecret = config('smaregi.smaregi_app_client_secret');
        // print_r("***************");
        // print_r($clientId);
        // print_r($clientSecret);
        $merged = "$clientId:$clientSecret";
        return base64_encode($merged);
    }


    /**
     * @param mixed $access_token
     *
     * @return [type]
     */
    public function setSmaregiAccessToken($access_token = null)
    {
        if ($access_token == null) {
            $loginDetail = $this->login();
            $access_token = $loginDetail->access_token ?? null;
        }
        $this->smaregi_access_token = $access_token;
    }

    /**
     * @param mixed $access_token
     *
     * @return [type]
     */
    public function getSmaregiAccessToken()
    {
        return $this->smaregi_access_token;
    }

    /**
     * @param mixed $feature_name
     * 
     * @return mixed
     */
    public function getSmaregiCallUri($feature_name)
    {
        $features = config('smaregi.smaregi_api_list');
        if ($feature_name == 'token') {
            return config('smaregi.smaregi_base_auth_api_url') . config('smaregi.smaregi_contract_id') . '/token';
        } else {
            if (isset($features[$feature_name])) {
                return config('smaregi.smaregi_base_api_url') . config('smaregi.smaregi_contract_id') . config('smaregi.smaregi_api_list')[$feature_name];
            } else {
                return null;
            }
        }
    }

    /**
     * @param mixed $datas
     * 
     * @return mixed
     */
    public function getURLQuery($datas = null)
    {
        if ($datas != null) {
            return $returnData = '?' . http_build_query($datas);
        }
    }
}