<?php

namespace RevoSystems\SageLiveApi\SObjects;

use RevoSystems\SageLiveApi\SageResource;

class SageClient extends SageResource
{
    const RESOURCE_NAME = "Account";

    protected $tag      = ["UID" => 'Customer', "Object" => "s2cor__Account__c"];
    protected $fields   = [
        "AccountNumber"                          => ["required" => false, "type" => "Text(40)"],
        "AccountSource"                          => ["required" => false, "type" => "Picklist"],
        "Active__c"                              => ["required" => false, "type" => "Picklist"],
        "AnnualRevenue"                          => ["required" => false, "type" => "Currency(18, 0)"],
        "BillingAddress"                         => ["required" => false, "type" => "Address"],
        "CreatedById"                            => ["required" => false, "type" => "Lookup(User)"],
        "CustomerPriority__c"                    => ["required" => false, "type" => "Picklist"],
        "DandbCompanyId"                         => ["required" => false, "type" => "Lookup(D&B Company)"],
        "Description"                            => ["required" => false, "type" => "Long Text Area(32000)"],
        "DunsNumber"                             => ["required" => false, "type" => "Text(9)"],
        "Fax"                                    => ["required" => false, "type" => "Fax"],
        "Industry"                               => ["required" => false, "type" => "Picklist"],
        "Jigsaw"                                 => ["required" => false, "type" => "Text(20)"],
        "LastModifiedById"                       => ["required" => false, "type" => "Lookup(User)"],
        "NaicsCode"                              => ["required" => false, "type" => "Text(8)"],
        "NaicsDesc"                              => ["required" => false, "type" => "Text(120)"],
        "Name"                                   => ["required" => true ,  "type" => "Name"],
        "NumberOfEmployees"                      => ["required" => false, "type" => "Number(8, 0)"],
        "NumberofLocations__c"                   => ["required" => false, "type" => "Number(3, 0)"],
        "OwnerId"                                => ["required" => false, "type" => "Lookup(User)"],
        "Ownership"                              => ["required" => false, "type" => "Picklist"],
        "ParentId"                               => ["required" => false, "type" => "Hierarchy"],
        "Phone"                                  => ["required" => false, "type" => "Phone"],
        "Rating"                                 => ["required" => false, "type" => "Picklist"],
        "s2cor__Country_Code__c"                 => ["required" => false, "type" => "Picklist"],
        "s2cor__Email_address__c"                => ["required" => false, "type" => "Email"],
        "s2cor__EU_Country_Code__c"              => ["required" => false, "type" => "Picklist"],
        "s2cor__Gift_Aid__c"                     => ["required" => false, "type" => "Checkbox"],
        "s2cor__Gift_Aid_Start_Date__c"          => ["required" => false, "type" => "Date"],
        "s2cor__HB_BC_CompanyId__c"              => ["required" => false, "type" => "Text(37) (External ID) (Unique Case Insensitive)"],
        "s2cor__Record_1099__c"                  => ["required" => false, "type" => "Checkbox"],
        "s2cor__Record_T4A__c"                   => ["required" => false, "type" => "Picklist"],
        "s2cor__Record_T5018__c"                 => ["required" => false, "type" => "Checkbox"],
        "s2cor__Registration_Number_Type__c"     => ["required" => false, "type" => "Picklist"],
        "s2cor__Sage_UID__c"                     => ["required" => false, "type" => "Text(128) (External ID) (Unique Case Sensitive)"],
        "s2cor__VAT_Registration_Number__c"      => ["required" => false, "type" => "Text(15)"],
        "ShippingAddress"                        => ["required" => false, "type" => "Address"],
        "Sic"                                    => ["required" => false, "type" => "Text(20)"],
        "SicDesc"                                => ["required" => false, "type" => "Text(80)"],
        "Site"                                   => ["required" => false, "type" => "Text(80)"],
        "SLA__c"                                 => ["required" => false, "type" => "Picklist"],
        "SLAExpirationDate__c"                   => ["required" => false, "type" => "Date"],
        "SLASerialNumber__c"                     => ["required" => false, "type" => "Text(10)"],
        "TickerSymbol"                           => ["required" => false, "type" => "Content(20)"],
        "Tradestyle"                             => ["required" => false, "type" => "Text(255)"],
        "Type"                                   => ["required" => false, "type" => "Picklist"],
        "UpsellOpportunity__c"                   => ["required" => false, "type" => "Picklist"],
        "Website"                                => ["required" => false, "type" => "URL(255)"],
        "YearStarted"                            => ["required" => false, "type" => "Text(4)"],
    ];
}
