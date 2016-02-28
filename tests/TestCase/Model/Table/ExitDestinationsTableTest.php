<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExitDestinationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExitDestinationsTable Test Case
 */
class ExitDestinationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExitDestinationsTable
     */
    public $ExitDestinations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exit_destinations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExitDestinations') ? [] : ['className' => 'App\Model\Table\ExitDestinationsTable'];
        $this->ExitDestinations = TableRegistry::get('ExitDestinations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExitDestinations);

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
