<?php

namespace RevoSystems\SageLiveApi\SObjects;

use RevoSystems\SageLiveApi\SageLiveSObject;

class SageLiveDimension extends SageLiveSObject
{
    const RESOURCE_NAME = "s2cor__Sage_ACC_Dimension__c";

    protected $fields = [
        "CreatedById"                       => ["required" => false, "type" => "Lookup(User)"                       ],
        "LastModifiedById"                  => ["required" => false, "type" => "Lookup(User)"                       ],
        "Name"                              => ["required" => false, "type" => "Text(80)"                           ],
        "OwnerId"                           => ["required" => false, "type" => "Lookup(User,Group)"                 ],
        "s2cor__Allow_New_Values__c"        => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Area__c"                    => ["required" => false, "type" => "Picklist (Multi-Select)"            ],
        "s2cor__Auto_Number_Format__c"      => ["required" => false, "type" => "Text(128)"                          ],
        "s2cor__Auto_Number_Key__c"         => ["required" => false, "type" => "Text(255)"                          ],
        "s2cor__Auto_Number_Start__c"       => ["required" => false, "type" => "Number(14, 0)"                      ],
        "s2cor__Balance_Account__c"         => ["required" => false, "type" => "Lookup(Ledger Account)"             ],
        "s2cor__Code_Format__c"             => ["required" => false, "type" => "Text(128)"                          ],
        "s2cor__Description__c"             => ["required" => false, "type" => "Long Text Area(32768) "             ],
        "s2cor__Is_Posting_Rule_Mapping__c" => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Is_Public__c"               => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Is_Reconcilable__c"         => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Is_Universal__c"            => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Key__c"                     => ["required" => false, "type" => "Text(80) (Unique Case Insensitive)" ],
        "s2cor__Level_1__c"                 => ["required" => false, "type" => "Text(80)"                           ],
        "s2cor__Level_2__c"                 => ["required" => false, "type" => "Text(80)"                           ],
        "s2cor__Maintain_Period_Values__c"  => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Maintain_Unit_Values__c"    => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Number__c"                  => ["required" => false, "type" => "Number(2, 0) (Unique)"              ],
        "s2cor__Plural_Name__c"             => ["required" => false, "type" => "Text(100)"                          ],
        "s2cor__Protect_Posting__c"         => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Show_On_Mobile_Menu__c"     => ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Statement_Report__c"        => ["required" => false, "type" => "Text Area(255)"                     ],
        "s2cor__Template__c"                => ["required" => false, "type" => "Lookup(Template)"                   ],
        "s2cor__Treat_Credit_As_Positive__c"=> ["required" => false, "type" => "Checkbox"                           ],
        "s2cor__Type__c"                    => ["required" => false, "type" => "Picklist"                           ],
        "s2cor__UID__c"                     => ["required" => false, "type" => "Text(128) (External ID) (Unique Case Sensitive)" ],
    ];
}
