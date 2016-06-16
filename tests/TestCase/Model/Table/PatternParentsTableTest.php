<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PatternParentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PatternParentsTable Test Case
 */
class PatternParentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PatternParentsTable
     */
    public $PatternParents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pattern_parents',
        'app.employees',
        'app.counties',
        'app.exit_reasons',
        'app.roles',
        'app.role_groups',
        'app.nationalities',
        'app.ethnicities',
        'app.exit_destinations',
        'app.patterns',
        'app.resources',
        'app.events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PatternParents') ? [] : ['className' => 'App\Model\Table\PatternParentsTable'];
        $this->PatternParents = TableRegistry::get('PatternParents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PatternParents);

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
