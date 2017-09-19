<?php

namespace App;

use App\SObjects\SageDimension;
use App\SObjects\SageTag;
use App\Validators\SageValidator;

class SageResource {

    const RESOURCE_NAME = '';
    protected $api;
    protected $attributes;
    protected $fields;
    protected $tag = null;
    public $id;
    public $tags;

    public function __construct($json = null){
        $this->api = app(SageApi::class);
        $this->attributes = collect($json);
        $this->fields = collect($this->fields);
    }

    public static function make() {
        return new static();
    }

    public function validate(){
        return (new SageValidator($this->fields, $this->attributes))->validate();
    }

    public static function all(){
        $attributes = collect(app(SageApi::class)->get(static::RESOURCE_NAME)["records"]);
        return $attributes->map(function($data){
            return new static($data);
        });
    }

    public static function count(){
        return app(SageApi::class)->get(static::RESOURCE_NAME)["totalSize"];
    }

    public function countWithFields(){
        $resource = app(SageApi::class)->get(static::RESOURCE_NAME, $this->fields);
        try {
            return $resource["totalSize"];
        } catch (\Exception $e) {
            dd(static::RESOURCE_NAME,$resource);
        }
    }

    public static function find($id){
        return new static(
            app(SageApi::class)->find(static::RESOURCE_NAME, $id)
        );
    }

    public static function findByUID($uid){
        return new static(
            app(SageApi::class)->findByUID(static::RESOURCE_NAME, $uid)['records'][0]
        );
    }

    public function create( $tags = [] ){
        $this->Id = $this->api->post(static::RESOURCE_NAME, $this->validate());
        return $this->createTags($tags);
    }

    public function createTags($tags = []){
        if ( $this->tag ) array_push($tags, $this->tag);

        $this->tags = collect($tags)->map(function ($tag) {
            return (new SageTag([
                "s2cor__Dimension__c"   => SageDimension::findByUID($tag["UID"])->Id,
                "s2cor__Active__c"      => 1,
                $tag["Object"]          => $this->Id,
            ]))->create();
        });
        return $this;
    }

    public function destroy(){
        $this->tags->each(function ($tag) {
            $tag->destroy();
        });
        app(SageApi::class)->delete(static::RESOURCE_NAME, $this->Id);
    }

    function __get($name) {
        if ( array_has($this->attributes, $name) ) {
            return $this->attributes[$name];
        }
        return null;
    }
}
