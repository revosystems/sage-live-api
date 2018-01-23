<?php

namespace Tests\Unit;

use Dotenv\Dotenv;
use RevoSystems\SageApi\Api;
use RevoSystems\SageApi\Auth;
use PHPUnit\Framework\TestCase;

abstract class SageLiveBaseTest extends TestCase
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
            $this->api = new Api(new Auth(getenv('CLIENT_ID'), getenv('CLIENT_SECRET')));
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
