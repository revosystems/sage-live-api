<?php

namespace Tests\Unit;

use RevoSystems\SageLiveApi\SObjects\SageLiveProduct;

class SageLiveProductsTest extends SageLiveBaseTest
{
    /** @test */
    public function can_create_sage_product()
    {
        $this->sageLogin();
        $clientResource = (new SageLiveProduct($this->api));
        $products_count = $clientResource->count();

        $this->object = (new SageLiveProduct($this->api, [
            "Name"      => "Nike Nuce",
            "IsActive"  => 1,
        ]))->create();

        $this->assertNotNull($this->object->Id);
        $this->assertNotEmpty($this->object->tags);
        $this->assertEquals($products_count + 1, $clientResource->count());
    }

    /** @test */
    public function can_get_sage_products()
    {
        $this->sageLogin();

        $this->object = (new SageLiveProduct($this->api, [
            "Name"      => "Nike Tomal",
            "IsActive"  => 1,
        ]))->create();

        $this->assertGreaterThanOrEqual(1, (new SageLiveProduct($this->api))->count());
    }

    /** @test */
    public function can_see_a_sage_product()
    {
        $this->sageLogin();
        $this->object = (new SageLiveProduct($this->api, [
            "Name"      => "Nike Tomaleos",
            "IsActive"  => 1,
        ]))->create();

        $productRetrieved = (new SageLiveProduct($this->api))->find($this->object->Id);
        $this->assertEquals($this->object->Id, $productRetrieved->Id);
        $this->assertEquals('Nike Tomaleos', $productRetrieved->Name);
    }

    /** @test */
    public function can_delete_sage_product()
    {
        $this->sageLogin();
        $this->object = (new SageLiveProduct($this->api, [
            "Name"      => "Nike Tomaleos",
            "IsActive"  => 1,
        ]))->create();
        $sageResource   = (new SageLiveProduct($this->api));
        $products_count = $sageResource->count();

        $this->object->destroy();
        $actual_products_count =  $sageResource->count();

        $this->assertEquals($products_count - 1, $actual_products_count);
        $this->object = null;
    }
}
