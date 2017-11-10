<?php

namespace RevoSystems\SageLiveApi;

use RevoSystems\SageLiveApi\Exceptions\WrongSageAccessTokenException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Zttp\Zttp;

class SageApi
{
    const SAGE_LOGIN = "https://login.salesforce.com";

    protected $client_id;
    protected $client_secret;

    public $access_token;
    public $refresh_token;
    public $instance_url;
    public $log = [];

    public function __construct($client_id, $client_secret)
    {
        $this->client_id        = $client_id;
        $this->client_secret    = $client_secret;
    }

    public function loginBasic($username, $password, $securityToken)
    {
        return $this->parseResponse(Zttp::asFormParams()->post(static::SAGE_LOGIN . "/services/oauth2/token", [
            "grant_type"    => 'password',
            "client_id"     => $this->client_id,
            "client_secret" => $this->client_secret,
            "username"      => $username,
            "password"      => $password . $securityToken,
        ]));
    }

    public static function getOauth2LoginUri($client_id, $redirect_uri)
    {
        return static::SAGE_LOGIN . "/services/oauth2/authorize?response_type=code&client_id={$client_id}&redirect_uri={$redirect_uri}";
    }

    public function loginCallback($redirect_uri, $code)
    {
        return $this->parseResponse(Zttp::asFormParams()->post(static::SAGE_LOGIN . "/services/oauth2/token", [
            "grant_type"    => "authorization_code",
            "client_id"     => $this->client_id,
            "client_secret" => $this->client_secret,
            "redirect_uri"  => $redirect_uri,
            "code"          => $code
        ]));
    }

    public function setInstance($access_token, $instance_url, $refresh_token = "")
    {
        $this->access_token     = $access_token;
        $this->instance_url     = $instance_url;
        $this->refresh_token    = $refresh_token;
        return $this;
    }

    private function parseResponse($response)
    {
        if ($response->status() != 200) {
            throw new WrongSageAccessTokenException();
        }
        $response = $response->json();
        return $this->setInstance($response["access_token"], $response["instance_url"], $response["refresh_token"] ?? "");
    }

    public function getAuthHeaders()
    {
        return [
            "Authorization" => "Bearer {$this->access_token}", "Content-Type" => "application/json"
        ];
    }

    public function urlForResource($resource)
    {
        return "{$this->instance_url}/services/data/v40.0/sobjects/{$resource}";
    }

    public function urlForQueries()
    {
        return "{$this->instance_url}/services/data/v40.0/query/";
    }

    public function find($resource, $id)
    {
        return Zttp::withHeaders($this->getAuthHeaders())
            ->get($this->urlForResource("{$resource}/{$id}"))
            ->json();
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
        $response = Zttp::withHeaders($this->getAuthHeaders())->post($this->urlForResource($resource), $data);
        $json     = $this->validateResponse($response, $resource);
        return $json ? $json["id"] : "";
    }

    public function delete($resource, $id)
    {
        $response = Zttp::withHeaders($this->getAuthHeaders())
            ->delete($this->urlForResource("{$resource}/{$id}"));
        if ($response->status() != Response::HTTP_NO_CONTENT) {
            $this->log("SAGE-API: Failed to delete resource {$resource} with id {$id}: {$response->body()}");
            return false;
        }
        return true;
    }

    private function validateResponse($response, $resource, $method = 'create')
    {
        if ($response->status() != 201) {
            if ($response->status() == 401) {
                dd('auth needed');
            }// reauth with refresh token and recall
            $this->log("SAGE-API: Failed to {$method} resource {$resource} with error {$response->status()}: {$response->body()}");
            return false;
        }
        return $response->json();
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
