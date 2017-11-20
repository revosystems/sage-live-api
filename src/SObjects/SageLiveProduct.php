<?php

namespace RevoSystems\SageLiveApi\SObjects;

use RevoSystems\SageLiveApi\SageLiveSObject;

class SageLiveProduct extends SageLiveSObject
{
    const RESOURCE_NAME = "Product2";
    protected $tag      = ["UID" => 'Product', "Object" => "s2cor__Product__c"];
    protected $fields   = [
        "CreatedById"               => ["required" => false, "type" => "Lookup(User)"                   ],
        "Description"               => ["required" => false, "type" => "Text Area(4000)"                ],
        "DisplayUrl"                => ["required" => false, "type" => "URL(1000)"                      ],
        "ExternalDataSourceId"      => ["required" => false, "type" => "Lookup(External Data Source)"   ],
        "ExternalId"                => ["required" => false, "type" => "Text(255)"                      ],
        "Family"                    => ["required" => false, "type" => "Picklist"                       ],
        "IsActive"                  => ["required" => false, "type" => "Checkbox"                       ],
        "LastModifiedById"          => ["required" => false, "type" => "Lookup(User)"                   ],
        "Name"                      => ["required" => true,  "type" => "Text(255)"                      ],
        "ProductCode"               => ["required" => false, "type" => "Text(255)"                      ],
        "QuantityUnitOfMeasure"     => ["required" => false, "type" => "Picklist"                       ],
        "s2cor__Height__c"          => ["required" => false, "type" => "Number(16, 2)"                  ],
        "s2cor__Job_Template__c"    => ["required" => false, "type" => "Lookup(Job)"                    ],
        "s2cor__Length__c"          => ["required" => false, "type" => "Number(16, 2)"                  ],
        "s2cor__Product_Group__c"   => ["required" => false, "type" => "Lookup(Product Group)"          ],
        "s2cor__Stock_Item__c"      => ["required" => false, "type" => "Checkbox"                       ],
        "s2cor__Template__c"        => ["required" => false, "type" => "Lookup(Job Template)"           ],
        "s2cor__UID__c"             => ["required" => false, "type" => "Text(128) (External ID) (Unique Case Insensitive)"],
        "s2cor__Weight__c"          => ["required" => false, "type" => "Number(16, 2)"                  ],
        "s2cor__Width__c"           => ["required" => false, "type" => "Number(16, 2) "                 ],
    ];
}
