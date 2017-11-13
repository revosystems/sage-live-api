<?php

namespace RevoSystems\SageLiveApi;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Zttp\Zttp;
use Zttp\ZttpResponse;

class SageApi
{
    use SageApiAuthTrait;
    public $log      = [];

    public function __construct($client_id, $client_secret)
    {
        $this->client_id        = $client_id;
        $this->client_secret    = $client_secret;
    }

    public function find($resource, $id)
    {
        $response = $this->call('get', $this->urlForResource("{$resource}/{$id}"), $this->getAuthHeaders());
        return $response instanceof ZttpResponse ? $response->json() : null;
    }

    public function findByUID($resource, $uid, $fields = ["Id", "Name"])
    {
        try {
            return Zttp::withHeaders($this->getAuthHeaders())
                ->get($this->urlForQueries() . "?q=SELECT+" . $this->getCollection($fields) . "+from+{$resource}+WHERE+s2cor__UID__c+LIKE+'{$uid}'+AND+isDeleted+=+false")
                ->json();
        } catch (\Exception $e) {
            $this->log("SAGE-API: Failed to find resource {$resource} with uid {$uid}: {$e->getMessage()}");
        }
    }

    public function get($resource, $fields = ["Id", "Name"])
    {
        return Zttp::withHeaders($this->getAuthHeaders())
            ->get($this->urlForQueries() . "?q=SELECT+" . $this->getCollection($fields) . "+from+{$resource}+WHERE+isDeleted+=+false")
            ->json();
    }

    public function post($resource, $data)
    {
        $data     = $data instanceof Collection ? $data->toArray() : $data;
        $response = $this->call('post', $this->urlForResource($resource), $data);
        return $response instanceof ZttpResponse ? $response->json()["id"] : '';
    }

    public function patch($resource, $id, $data)
    {
        $data     = $data instanceof Collection ? $data->toArray() : $data;
        $response = $this->call('patch', $this->urlForResource("{$resource}/{$id}"), $data);
        return $response instanceof ZttpResponse ? $response->json() : false;
    }

    public function delete($resource, $id)
    {
        return $this->call('delete', $this->urlForResource("{$resource}/{$id}"));
    }

    private function call($method, $url, $data = null)
    {
        $response = Zttp::withHeaders($this->getAuthHeaders())->$method($url, $data);
        $status   = $response->status();
        if ($status == Response::HTTP_UNAUTHORIZED) {
            $this->refreshToken();
            return $this->call($method, $url, $data);
        } elseif ($status < Response::HTTP_OK || $status > Response::HTTP_NO_CONTENT) {
            $this->log("SAGE-API: Failed to {$method} resource with error {$status}: {$response->body()}");
            return false;
        }
        return $response;
    }

    private function urlForResource($resource)
    {
        return "{$this->instance_url}/services/data/v40.0/sobjects/{$resource}";
    }

    private function urlForQueries()
    {
        return "{$this->instance_url}/services/data/v40.0/query/";
    }

    private function log($message)
    {
        array_push($this->log, $message);
    }

    private function getCollection($fields)
    {
        return ($fields instanceof Collection ? $fields->keys() : collect($fields))->implode(',');
    }
}
