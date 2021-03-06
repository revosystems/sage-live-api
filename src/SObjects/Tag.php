<?php

namespace RevoSystems\SageLiveApi\SObjects;

use RevoSystems\SageLiveApi\SObject;

class Tag extends SObject
{
    const RESOURCE_NAME = "s2cor__Sage_ACC_Tag__c";

    protected $fields = [
        "CreatedById"                                       => ["required" => false, "type" =>   "Lookup(User)"],
        "LastModifiedById"                                  => ["required" => false, "type" =>   "Lookup(User)"],
        "Name"                                              => ["required" => false, "type" =>   "Text(80)"],
        "OwnerId"                                           => ["required" => false, "type" =>   "Lookup(User,Group)"],
        "s2cor__Account__c"                                 => ["required" => false, "type" =>   "Lookup(Account)"],
        "s2cor__Account_Billing_Address__c"                 => ["required" => false, "type" =>   "Formula (Text)"],
        "s2cor__Active__c"                                  => ["required" => false, "type" =>   "Checkbox"],
        "s2cor__Age__c"                                     => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Associated_Ledger_Account__c"               => ["required" => false, "type" =>   "Lookup(Ledger Account)"],
        "s2cor__Base_Balance__c"                            => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Base_Balance_Signed__c"                     => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Base_Budget__c"                             => ["required" => false, "type" =>   "Number(16, 2)"],
        "s2cor__Base_Credit__c"                             => ["required" => false, "type" =>   "Number(16, 2)"],
        "s2cor__Base_Credit_Limit__c"                       => ["required" => false, "type" =>   "Number(16, 2)"],
        "s2cor__Base_Debit__c"                              => ["required" => false, "type" =>   "Number(16, 2)"],
        "s2cor__Billing_Address__c"                         => ["required" => false, "type" =>   "Formula (Text)"],
        "s2cor__Code__c"                                    => ["required" => false, "type" =>   "Text(80)"],
        "s2cor__Company__c"                                 => ["required" => false, "type" =>   "Lookup(Company)"],
        "s2cor__Contact__c"                                 => ["required" => false, "type" =>   "Lookup(Contact)"],
        "s2cor__Currency__c"                                => ["required" => false, "type" =>   "Lookup(Currency)"],
        "s2cor__Currency_Balance__c"                        => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Current_Exchange_Rate__c"                   => ["required" => false, "type" =>   "Number(10, 8)"],
        "s2cor__Days_Since_End__c"                          => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Days_Since_Start__c"                        => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Days_To_Reconcile__c"                       => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Dimension__c"                               => ["required" => false, "type" =>   "Lookup(Dimension)"],
        "s2cor__Dimension_UID__c"                           => ["required" => false, "type" =>   "Formula (Text)"],
        "s2cor__Employee__c"                                => ["required" => false, "type" =>   "Lookup(Employee)"],
        "s2cor__End_Date__c"                                => ["required" => false, "type" =>   "Date"],
        "s2cor__Exchange_Rate_Difference__c"                => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Exchange_Rate_Unreconciled__c"              => ["required" => false, "type" =>   "Formula (Checkbox)"],
        "s2cor__Foreign_Balance__c"                         => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Foreign_Balance_Signed__c"                  => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Foreign_Credit__c"                          => ["required" => false, "type" =>   "Number(16, 2)"],
        "s2cor__Foreign_Debit__c"                           => ["required" => false, "type" =>   "Number(16, 2)"],
        "s2cor__Initial_Exchange_Rate__c"                   => ["required" => false, "type" =>   "Number(10, 8)"],
        "s2cor__Is_Current_Company__c"                      => ["required" => false, "type" =>   "Formula (Checkbox)"],
        "s2cor__Is_Public__c"                               => ["required" => false, "type" =>   "Checkbox"],
        "s2cor__Is_Reconcilable__c"                         => ["required" => false, "type" =>   "Formula (Checkbox)"],
        "s2cor__Is_Reconciled__c"                           => ["required" => false, "type" =>   "Formula (Checkbox)"],
        "s2cor__Is_Reconciled_Before_Retrospective_Date__c" => ["required" => false, "type" =>   "Formula (Checkbox)"],
        "s2cor__Is_Selected_By_Me__c"                       => ["required" => false, "type" =>   "Formula (Checkbox)"],
        "s2cor__IsFilteredTag__c"                           => ["required" => false, "type" =>   "Formula (Checkbox)"],
        "s2cor__Job__c"                                     => ["required" => false, "type" =>   "Lookup(Job)"],
        "s2cor__Latest_Transaction_Date__c"                 => ["required" => false, "type" =>   "Date"],
        "s2cor__Level_1__c"                                 => ["required" => false, "type" =>   "Text(80)"],
        "s2cor__Level_2__c"                                 => ["required" => false, "type" =>   "Text(80)"],
        "s2cor__Level_3__c"                                 => ["required" => false, "type" =>   "Text(80)"],
        "s2cor__Product__c"                                 => ["required" => false, "type" =>   "Lookup(Product)"],
        "s2cor__Protect_Posting__c"                         => ["required" => false, "type" =>   "Checkbox"],
        "s2cor__Reconciled_Date__c"                         => ["required" => false, "type" =>   "Date"],
        "s2cor__Retrospective_Days_Since_End_Date__c"       => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Shipping_Address__c"                        => ["required" => false, "type" =>   "Formula (Text)"],
        "s2cor__Short_Name__c"                              => ["required" => false, "type" =>   "Formula (Text)"],
        "s2cor__Start_Date__c"                              => ["required" => false, "type" =>   "Date"],
        "s2cor__Tax_Code__c"                                => ["required" => false, "type" =>   "Lookup(Tax Code)"],
        "s2cor__Tax_Rate__c"                                => ["required" => false, "type" =>   "Lookup(Tax Rate)"],
        "s2cor__Tax_Treatment__c"                           => ["required" => false, "type" =>   "Lookup(Tax Treatment)"],
        "s2cor__Template__c"                                => ["required" => false, "type" =>   "Lookup(Template)"],
        "s2cor__Transaction__c"                             => ["required" => false, "type" =>   "Lookup(Transaction)"],
        "s2cor__UID__c"                                     => ["required" => false, "type" =>   "Text(128) (External ID) (Unique Case Sensitive)"],
        "s2cor__Unit__c"                                    => ["required" => false, "type" =>   "Lookup(Unit)"],
        "s2cor__Unit_Balance__c"                            => ["required" => false, "type" =>   "Formula (Number)"],
        "s2cor__Unit_Credit__c"                             => ["required" => false, "type" =>   "Number(12, 6)"],
        "s2cor__Unit_Debit__c"                              => ["required" => false, "type" =>   "Number(12, 6)"],
        "s2cor__Unit_Value__c"                              => ["required" => false, "type" =>   "Number(16, 2)"],
        "s2cor__User__c"                                    => ["required" => false, "type" =>   "Lookup(User)"],
    ];
}
