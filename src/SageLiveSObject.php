<?php

namespace RevoSystems\SageLiveApi;

use RevoSystems\SageLiveApi\SObjects\SageLiveDimension;
use RevoSystems\SageLiveApi\SObjects\SageLiveTag;
use RevoSystems\SageLiveApi\Validators\SageValidator;

class SageLiveSObject
{
    const RESOURCE_NAME = '';
    protected $api;
    protected $attributes;
    protected $fields;
    protected $tag = null;

    public $id;
    public $tags;

    /**
     * SageResource constructor.
     * @param SageLiveSObjectApi $api
     * @param null $json
     */
    public function __construct(SageLiveSObjectApi $api, $json = null)
    {
        $this->api        = $api;
        $this->attributes = collect($json);
        $this->fields     = collect($this->fields);
    }

    /**
     * @param SageLiveSObjectApi $api
     * @return static
     */
    public static function make(SageLiveSObjectApi $api)
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

    /**
     * @param array $tags
     * @return SageResource
     */
    public function create($tags = [])
    {
        $this->Id = $this->api->post(static::RESOURCE_NAME, $this->validate());
        return $this->Id != "" ? $this->createTags($tags) : $this;
    }

    /**
     * @param $attributes
     * @return $this
     */
    public function update($attributes)
    {
        $this->attributes = $this->attributes->merge($attributes);
        $this->api->patch(static::RESOURCE_NAME, $this->Id, $this->validate(collect($attributes), false));
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

    private function createTags($tags = [])
    {
        if ($this->tag) {
            array_push($tags, $this->tag);
        }

        $this->tags = collect($tags)->map(function ($tag) {
            return (new SageLiveTag($this->api, [
                "s2cor__Dimension__c"   => (new SageLiveDimension($this->api))->findByUID($tag["UID"])->Id,
                "s2cor__Active__c"      => 1,
                $tag["Object"]          => $this->Id,
            ]))->create();
        });
        return $this;
    }

}
