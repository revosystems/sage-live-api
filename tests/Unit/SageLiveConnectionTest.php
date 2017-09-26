<?php

namespace Tests\Unit;

use RevoSystems\SageLiveApi\SageApi;
use RevoSystems\SageLiveApi\SageResource;

class SageLiveConnectionTest extends SageLiveBaseTest {

    /** @test */
    public function can_get_oauth_access_token_from_sage_live() {
        $this->sageApi->login(getenv('TEST_SAGE_USERNAME'), getenv('TEST_SAGE_PASSWORD'), getenv('TEST_SAGE_SECURITY_TOKEN'));
        $this->assertNotNull($this->sageApi->access_token);
    }

}
