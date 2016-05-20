<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResourceGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResourceGroupsTable Test Case
 */
class ResourceGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResourceGroupsTable
     */
    public $ResourceGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.resource_groups',
        'app.resources',
        'app.events',
        'app.patterns',
        'app.employees',
        'app.counties',
        'app.exit_reasons',
        'app.roles',
        'app.role_groups',
        'app.nationalities',
        'app.ethnicities',
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
        $config = TableRegistry::exists('ResourceGroups') ? [] : ['className' => 'App\Model\Table\ResourceGroupsTable'];
        $this->ResourceGroups = TableRegistry::get('ResourceGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResourceGroups);

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
