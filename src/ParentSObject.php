<?php

namespace RevoSystems\SageLiveApi;

use RevoSystems\SageApi\Api;

class ParentSObject extends SObject
{
    protected $items;

    public function __construct(Api $api, $json = null)
    {
        if (isset($json["items"])) {
            $this->items = collect($json["items"]);
            unset($json["items"]);
        }
        parent::__construct($api, $json);
    }

    public function items()
    {
        return $this->items;
    }

    public function create($tags = [])
    {
        parent::create($tags);
        return $this->createItems();
    }

    public function createItems()
    {
        $this->items = collect($this->items)->map(function ($item) {
            $item->setParentId($this->Id);
            return $item->create();
        });
        return $this;
    }

    public function destroy()
    {
        collect($this->items)->each(function ($item) {
            $item->destroy();
        });
        parent::destroy();
    }
}
