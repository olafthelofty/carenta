<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DaypartsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DaypartsTable Test Case
 */
class DaypartsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DaypartsTable
     */
    public $Dayparts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dayparts',
        'app.shifts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dayparts') ? [] : ['className' => 'App\Model\Table\DaypartsTable'];
        $this->Dayparts = TableRegistry::get('Dayparts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dayparts);

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
