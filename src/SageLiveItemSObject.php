<?php

namespace RevoSystems\SageLiveApi;

class SageLiveItemSObject extends SageLiveSObject
{
    const PARENT_ID     = null;

    public function setParentId($parentId)
    {
        $this->attributes[static::PARENT_ID] = $parentId;
    }
}
