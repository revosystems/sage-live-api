<?php

namespace Tests\Unit;

use App\SageApi;

class SageLiveConnectionTest extends SageLiveBaseTest {

    /** @test */
    public function can_get_oauth_access_token_from_sage_live() {
        $sage = app(SageApi::class)->login(env('TEST_SAGE_USERNAME'), env('TEST_SAGE_PASSWORD'), env('TEST_SAGE_SECURITY_TOKEN'));
        $this->assertNotNull($sage->access_token);
    }

}
