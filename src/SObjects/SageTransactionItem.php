<?php

namespace App\SObjects;

use App\SageItemResource;

class SageTransactionItem extends SageItemResource {

    const RESOURCE_NAME = "s2cor__Sage_INV_Trade_Document_Item__c";
    const PARENT_ID     = "s2cor__Trade_Document__c";

    protected $fields = [
        "CreatedById"                               => [ "required" => false, "type" => "Lookup(User)"          ],
        "s2cor__Description__c"                     => [ "required" => false, "type" => "Text Area(255)"        ],
        "s2cor__Discount_Amount__c"                 => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Discount_Type__c"                   => [ "required" => false, "type" => "Picklist"              ],
        "s2cor__Discount_Value__c"                  => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Recognition_End_Date__c"            => [ "required" => false, "type" => "Date"                  ],
        "s2cor__Recurrent_End_Date__c"              => [ "required" => false, "type" => "Date"                  ],
        "s2cor__Foreign_Discount_Amount__c"         => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Foreign_Net_Amount__c"              => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Foreign_Tax_Amount__c"              => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Foreign_Total_Amount__c"            => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Recognition_Journal_Type__c"        => [ "required" => false, "type" => "Lookup(Journal Type)"  ],
        "LastModifiedById"                          => [ "required" => false, "type" => "Lookup(User)"          ],
        "s2cor__Ledger_Entry__c"                    => [ "required" => false, "type" => "Lookup(Ledger Entry)"  ],
        "s2cor__Legislation__c"                     => [ "required" => false, "type" => "Lookup(Legislation)"   ],
        "s2cor__Location__c"                        => [ "required" => false, "type" => "Lookup(Location)"      ],
        "s2cor__Net_Amount__c"                      => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Recognition_Day__c"                 => [ "required" => false, "type" => "Picklist"              ],
        "s2cor__Recurrent_Day__c"                   => [ "required" => false, "type" => "Picklist"              ],
        "s2cor__Recognition_Period_Type__c"         => [ "required" => false, "type" => "Picklist"              ],
        "s2cor__Recurrent_Period_Type__c"           => [ "required" => false, "type" => "Picklist"              ],
        "s2cor__Price_Book__c"                      => [ "required" => false, "type" => "Lookup(Price Book)"    ],
        "s2cor__Product__c"                         => [ "required" => false, "type" => "Lookup(Product)"       ],
        "s2cor__Product_Tag__c"                     => [ "required" => false, "type" => "Lookup(Dimension Tag)" ],
        "s2cor__Quantity__c"                        => [ "required" => false, "type" => "Number(8, 6)"          ],
        "s2cor__Recognition_Every__c"               => [ "required" => false, "type" => "Number(3, 0)"          ],
        "s2cor__Recurrent_Every__c"                 => [ "required" => false, "type" => "Number(3, 0)"          ],
        "Name"                                      => [ "required" => false, "type" => "Number"                ],
        "s2cor__Source_Trade_Document_Item__c"      => [ "required" => false, "type" => "Lookup(Transaction Item)"  ],
        "s2cor__Recognition_Start_Date__c"          => [ "required" => false, "type" => "Date"                  ],
        "s2cor__Recurrent_Start_Date__c"            => [ "required" => false, "type" => "Date"                  ],
        "s2cor__Stock_Item__c"                      => [ "required" => false, "type" => "Formula (Checkbox)"    ],
        "s2cor__Stock_Keeping_Unit__c"              => [ "required" => false, "type" => "Lookup(Stock Keeping Unit)" ],
        "s2cor__Tax_Amount__c"                      => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Tax_Code__c"                        => [ "required" => false, "type" => "Lookup(Tax Code)"      ],
        "s2cor__Tax_Rates__c"                       => [ "required" => false, "type" => "Text(255)"             ],
        "s2cor__VAT_Submission_Type__c"             => [ "required" => false, "type" => "Picklist"              ],
        "s2cor__Tax_Treatment__c"                   => [ "required" => false, "type" => "Lookup(Tax Treatment)" ],
        "s2cor__Toggle__c"                          => [ "required" => false, "type" => "Checkbox"              ],
        "s2cor__Total_Amount__c"                    => [ "required" => false, "type" => "Number(16, 2)"         ],
        "s2cor__Trade_Document__c"                  => [ "required" => false, "type" => "Master-Detail(Transaction)" ],
        "s2cor__UID__c"                             => [ "required" => false, "type" => "Text(128) (External ID) (Unique Case Sensitive)"],
        "s2cor__Unit_Price__c"                      => [ "required" => false, "type" => "Number(12, 6)"         ],
    ];
}
