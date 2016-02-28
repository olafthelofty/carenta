<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExitReasonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExitReasonsTable Test Case
 */
class ExitReasonsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExitReasonsTable
     */
    public $ExitReasons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exit_reasons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExitReasons') ? [] : ['className' => 'App\Model\Table\ExitReasonsTable'];
        $this->ExitReasons = TableRegistry::get('ExitReasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExitReasons);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
