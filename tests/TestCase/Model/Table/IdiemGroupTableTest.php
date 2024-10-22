<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IdiemGroupTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IdiemGroupTable Test Case
 */
class IdiemGroupTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IdiemGroupTable
     */
    protected $IdiemGroup;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.IdiemGroup',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('IdiemGroup') ? [] : ['className' => IdiemGroupTable::class];
        $this->IdiemGroup = $this->getTableLocator()->get('IdiemGroup', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->IdiemGroup);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\IdiemGroupTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
