<?php

namespace Arcplg\Smaregi\Tests;

use Arcplg\Smaregi\Smaregi;


class SimpleTest extends TestCase
{

    /** @test 
     * @return mixed
     */
    public function notest()
    {
        $smaregi = new Smaregi(['pos.products:read', 'pos.products:write']);
        return $this->assertEquals(config('smaregi.smaregi_access')[0]  . ' ' . config('smaregi.smaregi_access')[1], $smaregi->login());
    }

    public function testgetTransaction()
    {
        $smaregi = new Smaregi();
        $loginDetails = $smaregi->login();
        $transactionList = $smaregi->getTransaction(642, ["with_deposit_others" => "all"]);
        print_r($transactionList);
        return $this->assertIsArray($transactionList);
    }

    // /**
    //  * @test
    //  */
    // public function test_custom_scope()
    // {
    //     $smaregi = new Smaregi([1, 2, 3]);
    //     return $this->assertEquals("1 2 3", $smaregi->login());
    // }
}
