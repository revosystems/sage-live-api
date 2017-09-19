<?php

namespace Tests\Unit;

use App\SObjects\SageClient;

class SageLiveClientsTest extends SageLiveBaseTest {

    /** @test */
    public function can_create_sage_client() {
        $this->sageLogin();
        $clients_count = SageClient::count();

        $this->object = (new SageClient([
            "Name" => "Jordi",
        ]))->create();

        $this->assertNotFalse( $this->object->id );
        $this->assertNotEmpty( $this->object->tags );
        $this->assertEquals( $clients_count + 1, SageClient::count());
    }

    /** @test */
    public function can_get_sage_clients() {
        $this->sageLogin();
        $this->object = (new SageClient([
            "Name" => "Jordi",
        ]))->create();

        $this->assertGreaterThanOrEqual(1, SageClient::count());

    }

    /** @test */
    public function can_see_a_sage_client() {
        $this->sageLogin();
        $this->object = (new SageClient([
            "Name" => "Jordi",
        ]))->create();

        $client = SageClient::find($this->object->Id);
        $this->assertEquals($this->object->Id,   $client->Id);
        $this->assertEquals('Jordi',             $client->Name);
    }

    /** @test */
    public function can_delete_sage_client() {
        $this->sageLogin();
        $this->object = (new SageClient([
            "Name" => "Jordi",
        ]))->create();
        $clients_count = SageClient::count();

        $this->object->destroy();
        $actual_clients_count =  SageClient::count();

        $this->assertEquals( $clients_count - 1, $actual_clients_count);
    }
}
