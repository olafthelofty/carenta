<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoleGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoleGroupsTable Test Case
 */
class RoleGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoleGroupsTable
     */
    public $RoleGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.role_groups',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoleGroups') ? [] : ['className' => 'App\Model\Table\RoleGroupsTable'];
        $this->RoleGroups = TableRegistry::get('RoleGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoleGroups);

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
