<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PatternsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PatternsTable Test Case
 */
class PatternsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PatternsTable
     */
    public $Patterns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Patterns') ? [] : ['className' => 'App\Model\Table\PatternsTable'];
        $this->Patterns = TableRegistry::get('Patterns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Patterns);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
