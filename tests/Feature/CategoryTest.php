<?php

namespace Arcplg\Smaregi\Tests;

use Arcplg\Smaregi\Smaregi;



class CategoryTest extends TestCase
{
    /** @test 
     * @return mixed
     */
    public function testgetCategories()
    {
        $smaregi = new Smaregi();
        $categoryList = $smaregi->getCategories();
        // print_r($categoryList);
        return $this->assertIsArray($categoryList);
    }

    // createOrUpdateCategoryをテストする
    /** @test 
     * @return mixed
     */
    public function testcreateOrUpdateCategory() {
        $smaregi = new Smaregi();
        $values = [
            "categoryCode" => "034",
            "categoryName" => "カーペットちゃん",
            "categoryAbbr" => "カーペット",
            "displaySequence" => '1',
            "displayFlag" => '1',
            "taxDivision" => null,
            "pointNotApplicable" => '0',
            "taxFreeDivision" => '1',
            "reduceTaxId" => null,
            "color" => null,
            "categoryGroupId" => null,
            "parentCategoryId" => null,
            // "level" => 1,
            "tag" => "リビング,家具"
        ];
        $create = $smaregi->createOrUpdateCategory($values);
        print_r($create);
        return $this->assertEquals(200, $create['status_code']);
    }
}
