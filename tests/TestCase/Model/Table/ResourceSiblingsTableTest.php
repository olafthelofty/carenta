<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResourceSiblingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResourceSiblingsTable Test Case
 */
class ResourceSiblingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResourceSiblingsTable
     */
    public $ResourceSiblings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.resource_siblings',
        'app.resources'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResourceSiblings') ? [] : ['className' => 'App\Model\Table\ResourceSiblingsTable'];
        $this->ResourceSiblings = TableRegistry::get('ResourceSiblings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResourceSiblings);

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
