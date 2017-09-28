<?php

namespace Tests\Unit;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use RevoSystems\SageLiveApi\SageApi;

class SageLiveBaseTest extends TestCase
{
    protected $object;
    protected $sageApi = null;

    public function setUp()
    {
        parent::setUp();
        $this->loadEnv();
        $this->sageApi = $this->getSageApi();
    }

    public function getSageApi()
    {
        if (! $this->sageApi) {
            $this->sageApi = new SageApi(getenv('SAGE_INSTANCE'), getenv('CLIENT_ID'), getenv('CLIENT_SECRET'));
        }
        return $this->sageApi;
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
        return $this->sageApi->login(getenv('TEST_SAGE_USERNAME'), getenv('TEST_SAGE_PASSWORD'), getenv('TEST_SAGE_SECURITY_TOKEN'));
    }

    /**
     * @return array
     */
    private function loadEnv()
    {
        return (new Dotenv(__DIR__, "../../.env"))->load();
    }
}
