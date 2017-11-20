<?php

namespace Tests\Unit;

use RevoSystems\SageLiveApi\SObjects\SageLiveAccount;
use RevoSystems\SageLiveApi\SObjects\SageLiveTransactionItem;
use RevoSystems\SageLiveApi\SObjects\SageLiveProduct;
use RevoSystems\SageLiveApi\SObjects\SageLiveTransaction;
use RevoSystems\SageLiveApi\SObjects\SageLiveTransactionType;

class SageLiveTransactionsTest extends SageLiveBaseTest
{
    protected $transaction;
    protected $type;
    protected $client;
    protected $products;

    public function tearDown()
    {
        $this->transaction->destroy();
        collect($this->products)->each(function ($product) {
            $product->destroy();
        });
        $this->type->destroy();
        $this->client->destroy();
    }

    /** @test */
    public function can_create_sage_transaction()
    {
        $this->sageLogin();
        $transactions_count       = SageLiveTransaction::make($this->api)->countWithFields();
        $transaction_items_count  = SageLiveTransactionItem::make($this->api)->countWithFields();
        $this->client             =   (new SageLiveAccount($this->api, ["Name" => "Jordi"]))->create();
        $this->type               = (new SageLiveTransactionType($this->api, [
            "s2cor__Active__c"                      => 1,
        ]))->create();
        $this->products  = [
            (new SageLiveProduct($this->api, ["IsActive" => 1, "Name" => "Nike Tomaleos"]))->create(),
            (new SageLiveProduct($this->api, ["IsActive" => 1, "Name" => "Addidas shoes"]))->create()
        ];

        $this->transaction = (new SageLiveTransaction($this->api, [
            "s2cor__Account__c"             => $this->client->Id,
            "s2cor__Trade_Document_Type__c" => $this->type->Id,
            "items"                         => [
                new SageLiveTransactionItem($this->api, [
                    "s2cor__Product__c"     => $this->products[0]->Id,
                    "s2cor__Quantity__c"    => 2,
                    "s2cor__Unit_Price__c"  => 5,
                ]),
                new SageLiveTransactionItem($this->api, [
                    "s2cor__Product__c"     => $this->products[1]->Id,
                    "s2cor__Quantity__c"    => 3,
                    "s2cor__Unit_Price__c"  => 4,
                ])
            ]
        ]))->create();

        $this->assertNotNull($this->transaction->Id);
        $this->assertNotNull($this->transaction->items());
        $this->assertNotNull($this->transaction->items()[0]->Id);
        $this->assertNotNull($this->transaction->items()[1]->Id);
        $this->assertEquals($transactions_count + 1, (new SageLiveTransaction($this->api))->count());
        $this->assertEquals($transaction_items_count + 2, (new SageLiveTransactionItem($this->api))->all()->count());
    }
}
