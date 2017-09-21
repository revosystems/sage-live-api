<?php

namespace Tests\Unit;

use RevoSystems\SageLiveApi\SObjects\SageProduct;

class SageLiveProductsTest extends SageLiveBaseTest {

    /** @test */
    public function can_create_sage_product() {
        $this->sageLogin();
        $products_count = SageProduct::count();

        $this->object = (new SageProduct([
            "Name"      => "Nike Nuce",
            "IsActive"  => 1,
        ]))->create();

        $this->assertNotNull( $this->object->Id );
        $this->assertNotEmpty( $this->object->tags );
        $this->assertEquals( $products_count + 1, SageProduct::count());
    }

    /** @test */
    public function can_get_sage_products() {
        $this->sageLogin();

        $this->object = (new SageProduct([
            "Name"      => "Nike Tomal",
            "IsActive"  => 1,
        ]))->create();

        $this->assertGreaterThanOrEqual(1, SageProduct::count());
    }

    /** @test */
    public function can_see_a_sage_product() {
        $this->sageLogin();
        $this->object = (new SageProduct([
            "Name"      => "Nike Tomaleos",
            "IsActive"  => 1,
        ]))->create();

        $productRetrieved = SageProduct::find($this->object->Id);
        $this->assertEquals($this->object->Id,    $productRetrieved->Id);
        $this->assertEquals('Nike Tomaleos', $productRetrieved->Name);
    }

    /** @test */
    public function can_delete_sage_product() {
        $this->sageLogin();
        $this->object = (new SageProduct([
            "Name"      => "Nike Tomaleos",
            "IsActive"  => 1,
        ]))->create();
        $products_count = SageProduct::count();

        $this->object->destroy();
        $actual_products_count =  SageProduct::count();

        $this->assertEquals( $products_count - 1, $actual_products_count);
    }

}
