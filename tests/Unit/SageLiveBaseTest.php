<?php

namespace Tests\Unit;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use RevoSystems\SageLiveApi\SageResourceApi;

class SageLiveBaseTest extends TestCase
{
    protected $object;
    protected $sageApi;

    public function setUp()
    {
        parent::setUp();
        $this->loadEnv();
        $this->sageApi = $this->getSageApi();
    }

    public function getSageApi()
    {
        if (! $this->sageApi) {
            $this->sageApi = new SageResourceApi(getenv('CLIENT_ID'), getenv('CLIENT_SECRET'));
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
        return $this->sageApi->sageAuth->loginBasic(getenv('TEST_SAGE_USERNAME'), getenv('TEST_SAGE_PASSWORD'), getenv('TEST_SAGE_SECURITY_TOKEN'));
    }

    /**
     * @return array
     */
    private function loadEnv()
    {
        return (new Dotenv(__DIR__, "../../.env"))->load();
    }
}
