<?php

namespace Arcplg\Smaregi\Tests;

use Arcplg\Smaregi\Smaregi;


class ProductTest extends TestCase
{


    /** @test 
     * @return mixed
     */
    public function testProductlistStatusSuccess()
    {
        $smaregi = new Smaregi();
        $productList = $smaregi->getProductsList();
        return $this->assertEquals(200, $productList->status_code);


    }

    /** @testCreateProductStatusSuccess 
     * @return mixed
     */
    public function testCreateProductStatusSuccess()
    {
        $smaregi = new Smaregi();

        $singleValues = config('data.single_create');

        $create = $smaregi->createProduct($singleValues);

        return $this->assertEquals(200, $create['status_code']);


    }

    /**
     * testCreateProductStatusFailure
     *
     * @return mixed
     */
    public function testCreateProductStatusFailure()
    {
        $smaregi = new Smaregi();

        $singleValues = [];

        $create = $smaregi->createProduct($singleValues);
        return $this->assertEquals(401, $create['status_code']);


    }
    /**
     * testCreateBulkProductStatusSuccess
     *
     * @return mixed
     */
    public function testCreateBulkProductStatusSuccess()
    {
        $smaregi = new Smaregi();

        $bulkValues = config('data.bulk_create_products');

        $create = $smaregi->createBulkProducts($bulkValues);
        return $this->assertEquals(200, $create['status_code']);


    }


    /**
     * testCreateBulkProductStatusFailure
     *
     * @return mixed
     */
    public function testCreateBulkProductStatusFailure()
    {
        $smaregi = new Smaregi();

        $bulkValues = [];

        $create = $smaregi->createBulkProducts($bulkValues);
        return $this->assertEquals(401, $create['status_code']);


    }
    /**
     * testUpdateBulkProductStatusFailure
     *
     * @return mixed
     */
    public function testUpdateBulkProductStatusFailure()
    {
        $smaregi = new Smaregi();
        $bulk_update = '';
        $bulkUpdate = $smaregi->updateBulkProducts($bulk_update);
        return $this->assertEquals(401, $bulkUpdate['status_code']);


    }
    /**
     * testUpdateBulkProductStatusSuccess
     *
     * @return mixed
     */
    public function testUpdateBulkProductStatusSuccess()
    {
        $smaregi = new Smaregi();
        $bulk_update = config('data.bulk_update_products');
        $bulkUpdate = $smaregi->updateBulkProducts($bulk_update);
        return $this->assertEquals(200, $bulkUpdate['status_code']);


    }
    /**
     * testGetProductsListByQuery
     *
     * @return mixed
     */
    // product required field test case start from here @todo
    public function testGetProductsListByQuery()
    {
        $smaregi = new Smaregi();
        $query = ['product_code' => '360121'];
        $productList = $smaregi->getProductsList($query);
        print_r($productList);
        return $this->assertEquals('360121', $productList[0]->productCode);
    }
}
