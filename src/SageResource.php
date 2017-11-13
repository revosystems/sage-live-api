<?php

namespace RevoSystems\SageLiveApi;

use RevoSystems\SageLiveApi\SObjects\SageDimension;
use RevoSystems\SageLiveApi\SObjects\SageTag;
use RevoSystems\SageLiveApi\Validators\SageValidator;

class SageResource
{
    const RESOURCE_NAME = '';
    protected $api;
    protected $attributes;
    protected $fields;
    protected $tag = null;

    public $id;
    public $tags;

    public function __construct(SageApi $api, $json = null)
    {
        $this->api        = $api;
        $this->attributes = collect($json);
        $this->fields     = collect($this->fields);
    }

    public static function make(SageApi $api)
    {
        return new static($api);
    }

    public function validate($attributes = false, $withRequired = true)
    {
        return (new SageValidator($this->fields, $attributes ? : $this->attributes))->validate($withRequired);
    }

    public function all()
    {
        $attributes = collect($this->api->get(static::RESOURCE_NAME)["records"]);
        return $attributes->map(function ($data) {
            return new static($this->api, $data);
        });
    }

    public function count()
    {
        return $this->api->get(static::RESOURCE_NAME)["totalSize"];
    }

    public function countWithFields()
    {
        $resource = $this->api->get(static::RESOURCE_NAME, $this->fields);
        try {
            return $resource["totalSize"];
        } catch (\Exception $e) {
            dd(static::RESOURCE_NAME, $resource);
        }
    }

    public function find($id)
    {
        return new static($this->api,
            $this->api->find(static::RESOURCE_NAME, $id)
        );
    }

    public function findByUID($uid)
    {
        return new static($this->api,
            $this->api->findByUID(static::RESOURCE_NAME, $uid)['records'][0]
        );
    }

    public function create($tags = [])
    {
        $this->Id = $this->api->post(static::RESOURCE_NAME, $this->validate());
        return $this->Id != "" ? $this->createTags($tags) : $this;
    }

    public function update($attributes)
    {
        $this->attributes = $this->attributes->merge($attributes);
        $this->api->patch(static::RESOURCE_NAME, $this->Id, $this->validate(collect($attributes), false));
        return $this;
    }

    public function createTags($tags = [])
    {
        if ($this->tag) {
            array_push($tags, $this->tag);
        }

        $this->tags = collect($tags)->map(function ($tag) {
            return (new SageTag($this->api, [
                "s2cor__Dimension__c"   => (new SageDimension($this->api))->findByUID($tag["UID"])->Id,
                "s2cor__Active__c"      => 1,
                $tag["Object"]          => $this->Id,
            ]))->create();
        });
        return $this;
    }

    public function destroy()
    {
        collect($this->tags)->each(function ($tag) {
            $tag->destroy();
        });
        $this->api->delete(static::RESOURCE_NAME, $this->Id);
    }

    public function __get($name)
    {
        if (array_has($this->attributes, $name)) {
            return $this->attributes[$name];
        }
        return null;
    }
}
