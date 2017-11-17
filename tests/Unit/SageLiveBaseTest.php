<?php

namespace Tests\Unit;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use RevoSystems\SageLiveApi\SageLiveAuth;
use RevoSystems\SageLiveApi\SageResourceApi;

class SageLiveBaseTest extends TestCase
{
    protected $object;
    protected $api;

    public function setUp()
    {
        parent::setUp();
        $this->loadEnv();
        $this->api = $this->getSageApi();
    }

    public function getSageApi()
    {
        if (! $this->api) {
            $this->api = new SageResourceApi(new SageLiveAuth(getenv('CLIENT_ID'), getenv('CLIENT_SECRET')));
        }
        return $this->api;
    }

    public function tearDown()
    {
        if ($this->object) {
            $this->object->destroy();
        }
        parent::tearDown();
    }

    protected function sageLogin()
    {
        return $this->api->auth->loginBasic(getenv('TEST_SAGE_USERNAME'), getenv('TEST_SAGE_PASSWORD'), getenv('TEST_SAGE_SECURITY_TOKEN'));
    }

    /**
     * @return array
     */
    private function loadEnv()
    {
        return (new Dotenv(__DIR__, "../../.env"))->load();
    }
}
