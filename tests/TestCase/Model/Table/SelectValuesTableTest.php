<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SelectValuesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SelectValuesTable Test Case
 */
class SelectValuesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SelectValuesTable
     */
    protected $SelectValues;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.SelectValues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SelectValues') ? [] : ['className' => SelectValuesTable::class];
        $this->SelectValues = $this->getTableLocator()->get('SelectValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SelectValues);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SelectValuesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
