<?php

namespace RevoSystems\SageLiveApi;

class ItemSObject extends SObject
{
    const PARENT_ID     = null;

    public function setParentId($parentId)
    {
        $this->attributes[static::PARENT_ID] = $parentId;
    }
}
