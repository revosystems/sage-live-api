<?php

namespace RevoSystems\SageLiveApi;

use RevoSystems\SageLiveApi\Exceptions\WrongSageAccessTokenException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Zttp\Zttp;

class SageApi {

    const SAGE_URL = "salesforce.com";

    /**
     * @var string instance where you sage account is in
     */
    protected $instance;
    protected $client_secret;
    protected $client_id;

    public $access_token;

    public function __construct($instance, $client_id, $client_secret) {
        $this->instance         = $instance;
        $this->client_secret    = $client_secret;
        $this->client_id        = $client_id;
    }

    public function login($username, $password, $securityToken) {
        $response = Zttp::asFormParams()->post( "https://login." . static::SAGE_URL . "/services/oauth2/token", [
            "grant_type"    => 'password',
            "client_id"     => $this->client_id,
            "client_secret" => $this->client_secret,
            "username"      => $username,
            "password"      => $password.$securityToken,
        ]);
        if ( $response->status() != 200 ) throw new WrongSageAccessTokenException();

        $this->access_token = $response->json()["access_token"];
        return $this;
    }

    public function getAuthHeaders(){
        return [
            "Authorization" => "Bearer ".$this->access_token, "Content-Type" => "application/json"
        ];
    }

    public function urlForResource($resource){
        return "https://{$this->instance}." . static::SAGE_URL . "/services/data/v40.0/sobjects/{$resource}";
    }

    public function urlForQueries(){
        return "https://{$this->instance}." . static::SAGE_URL . "/services/data/v40.0/query/";
    }

    public function find($resource, $id){
        return Zttp::withHeaders($this->getAuthHeaders())
            ->get( $this->urlForResource($resource. '/'.$id) )
            ->json();
    }

    public function findByUID($resource, $uid, $fields = ["Id", "Name"]){
        return Zttp::withHeaders($this->getAuthHeaders())
            ->get( $this->urlForQueries() . "?q=SELECT+". $this->getCollection($fields) . "+from+{$resource}+WHERE+s2cor__UID__c+LIKE+'{$uid}'+AND+isDeleted+=+false" )
            ->json();
    }

    public function get($resource, $fields = ["Id","Name"]){
        return Zttp::withHeaders($this->getAuthHeaders())
            ->get( $this->urlForQueries() . "?q=SELECT+" . $this->getCollection($fields) . "+from+{$resource}+WHERE+isDeleted+=+false" )
            ->json();
    }

    public function post($resource, $data){
        $response = Zttp::withHeaders($this->getAuthHeaders())
                    ->post( $this->urlForResource($resource) , $data instanceof Collection ? $data->toArray() : $data )
                    ->json();
        return $this->validateResponse($response, $resource)["id"];
    }

    public function delete($resource, $id){
        return Zttp::withHeaders($this->getAuthHeaders())
            ->delete( $this->urlForResource($resource) . '/' . $id)->status() == Response::HTTP_NO_CONTENT;
    }

    private function validateResponse($response, $resource) {
        if (! array_has($response, "success")) {
            throw new \Exception("Failed to create resource {$resource} with error: " . json_encode($response));
        }
        return $response;
    }

    private function getCollection($fields) {
        return ($fields instanceof Collection ? $fields->keys() : collect($fields))->implode(',');
    }
}
