<?php

namespace Tests\Unit;

use RevoSystems\SageLiveApi\SageApi;

class SageLiveConnectionTest extends SageLiveBaseTest {

    /** @test */
    public function can_get_oauth_access_token_from_sage_live() {
        $sage = app(SageApi::class)->login(getenv('TEST_SAGE_USERNAME'), getenv('TEST_SAGE_PASSWORD'), getenv('TEST_SAGE_SECURITY_TOKEN'));
//        $sage = $this->getSageApi()->login(getenv('TEST_SAGE_USERNAME'), getenv('TEST_SAGE_PASSWORD'), getenv('TEST_SAGE_SECURITY_TOKEN'));
        $this->assertNotNull($sage->access_token);
    }

}
