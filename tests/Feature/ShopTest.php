<?php

namespace Arcplg\Smaregi\Tests;

use Arcplg\Smaregi\Smaregi;


class ShopTest extends TestCase
{

    // createOrUpdateCategoryをテストする
    /** @test 
     * @return mixed
     */
    public function testcreateOrUpdateShop() {
        $smaregi = new Smaregi();
        $value = ["storeCode" => "0004", "storeName" => "天神店"];

        $create = $smaregi->createOrUpdateShop($value);
        print_r($create);
        return $this->assertEquals(200, $create['status_code']);
    }
}
