<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NavBarItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NavBarItemsTable Test Case
 */
class NavBarItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NavBarItemsTable
     */
    protected $NavBarItems;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.NavBarItems',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('NavBarItems') ? [] : ['className' => NavBarItemsTable::class];
        $this->NavBarItems = $this->getTableLocator()->get('NavBarItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->NavBarItems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\NavBarItemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\NavBarItemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
