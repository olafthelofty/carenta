<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ResourceGroupsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ResourceGroupsController Test Case
 */
class ResourceGroupsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
