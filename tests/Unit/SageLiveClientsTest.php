<?php

namespace Tests\Unit;

use RevoSystems\SageLiveApi\SObjects\SageLiveAccount;

class SageLiveClientsTest extends SageLiveBaseTest
{
    ///** @test */
    public function can_delete_all_sage_clients()
    {
        $this->sageLogin();
        (new SageLiveAccount($this->api))->all()->each(function ($client) {
            $client->destroy();
        });
        $this->object = null;
    }

    /** @test */
    public function can_create_sage_client()
    {
        $this->sageLogin();
        $clientResource = (new SageLiveAccount($this->api));
        $clients_count  = $clientResource->count();

        $this->object = (new SageLiveAccount($this->api, [
            "Name" => "Jordi",
        ]))->create();

        $this->assertNotFalse($this->object->id);
        $this->assertNotEmpty($this->object->tags);
        $this->assertEquals($clients_count + 1, $clientResource->count());
    }

    /** @test */
    public function can_update_sage_client()
    {
        $this->sageLogin();
        $clientResource = (new SageLiveAccount($this->api));
        $this->object   = (new SageLiveAccount($this->api, [
            "Name" => "Jordi",
        ]))->create();
        $clients_count  = $clientResource->count();

        $this->object->update([
            "Name" => "Joan"
        ]);

        $this->assertNotFalse($this->object->id);
        $this->assertNotEmpty($this->object->tags);
        $this->assertEquals("Joan", $this->object->Name);
        $client = (new SageLiveAccount($this->api))->find($this->object->Id);
        $this->assertEquals("Joan", $client->Name);
        $this->assertEquals($clients_count, $clientResource->count());
    }

    /** @test */
    public function can_get_sage_clients()
    {
        $this->sageLogin();

        $this->object = (new SageLiveAccount($this->api, [
            "Name" => "Jordi",
        ]))->create();

        $this->assertGreaterThanOrEqual(1, (new SageLiveAccount($this->api))->count());
    }

    /** @test */
    public function can_see_a_sage_client()
    {
        $this->sageLogin();
        $this->object = (new SageLiveAccount($this->api, [
            "Name" => "Jordi",
        ]))->create();

        $client = (new SageLiveAccount($this->api))->find($this->object->Id);

        $this->assertEquals($this->object->Id, $client->Id);
        $this->assertEquals('Jordi', $client->Name);
    }

    /** @test */
    public function can_delete_sage_client()
    {
        $this->sageLogin();
        $this->object = (new SageLiveAccount($this->api, [
            "Name" => "Jordi",
        ]))->create();
        $clients_count = (new SageLiveAccount($this->api))->count();

        $this->object->destroy();
        $actual_clients_count =  (new SageLiveAccount($this->api))->count();

        $this->assertEquals($clients_count - 1, $actual_clients_count);
        $this->object = null;
    }
}
