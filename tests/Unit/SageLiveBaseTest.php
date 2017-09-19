<?php

namespace Tests\Unit;

use App\SageApi;
use Tests\TestCase;

class SageLiveBaseTest extends TestCase {
    protected $object;

    public function setUp() {
        parent::setUp();
        app()->singleton(SageApi::class, function(){
           return new SageApi(env('SAGE_INSTANCE'), env('CLIENT_ID'), env('CLIENT_SECRET'));
        });
    }

    public function tearDown() {
        if ($this->object) $this->object->destroy();
        parent::tearDown();
    }

    protected function sageLogin(){
        app(SageApi::class)->login(env('TEST_SAGE_USERNAME'), env('TEST_SAGE_PASSWORD'), env('TEST_SAGE_SECURITY_TOKEN'));
    }

    /** @test */
    public function can_create_sage_product() {
        $this->assertTrue(true);
    }

}
