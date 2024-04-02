<?php

namespace Arcplg\Smaregi\Tests;

use Arcplg\Smaregi\Smaregi;


class PaymentMethodGroupTest extends TestCase
{

    //getPaymentMethodGroupGroupsをテストする
    /** @test 
     * @return mixed
     */
    public function testgetPaymentMethodGroups() {
        $smaregi = new Smaregi();
        $paymentMethodGroupList = $smaregi->getPaymentMethodGroups();
        print_r($paymentMethodGroupList);
        return $this->assertIsArray($paymentMethodGroupList);
    }
    // testcreateOrUpdatePaymentMethodをテストする
    /** @test 
     * @return mixed
     */
    public function testcreateOrUpdatePaymentMethodGroup() {
        $smaregi = new Smaregi();
        $value = [
            ["name" => "現金"],
            ["name" => "商品券"],
            ["name" => "クレジット"],
            ["name" => "売掛"],
            ["name" => "その他・電子マネー"],
            ["name" => "クレジット連動"],
        ];

        $paymentMethodGroupList = $smaregi->getPaymentMethodGroups();
        // $valueをループして$paymentMethodGroupListにnameがある場合はスキップ
        foreach ($value as $key => $val) {
            $create = $smaregi->createOrUpdatePaymentMethodGroup($val);
        }
        return true;
    }
}
