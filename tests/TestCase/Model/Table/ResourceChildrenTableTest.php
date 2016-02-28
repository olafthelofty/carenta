<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResourceChildrenTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResourceChildrenTable Test Case
 */
class ResourceChildrenTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResourceChildrenTable
     */
    public $ResourceChildren;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.resource_children'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResourceChildren') ? [] : ['className' => 'App\Model\Table\ResourceChildrenTable'];
        $this->ResourceChildren = TableRegistry::get('ResourceChildren', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResourceChildren);

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
