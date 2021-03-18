<?php

use CRM_Webhook_ExtensionUtil as E;
use Civi\Test\HeadlessInterface;
use Civi\Test\HookInterface;
use Civi\Test\TransactionalInterface;

/**
 * Base class for the form tests.
 */
class CRM_Webhook_Form_TestBase extends \PHPUnit\Framework\TestCase implements HeadlessInterface, HookInterface, TransactionalInterface {

    const TEST_SETTINGS = [
        "sequence" => 1,
        "webhooks" => [
            0 => [
                "name" => "test name",
                "label" => "test label",
                "description" => "test description",
                "handler" => "test_handler",
                "selector" => "test-selector",
            ],
        ],
    ];

    public function setUpHeadless() {
        return \Civi\Test::headless()
            ->installMe(__DIR__)
            ->apply();
    }

    public function setUp(): void {
        parent::setUp();
    }

    public function tearDown(): void {
        parent::tearDown();
    }

    protected function setupTestConfig() {
        $config = new CRM_Webhook_Config(E::LONG_NAME);
        self::assertTrue($config->update(self::TEST_SETTINGS), "Config update has to be successful.");
    }
}
