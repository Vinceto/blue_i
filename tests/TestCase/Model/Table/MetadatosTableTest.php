<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MetadatosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MetadatosTable Test Case
 */
class MetadatosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MetadatosTable
     */
    protected $Metadatos;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Metadatos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Metadatos') ? [] : ['className' => MetadatosTable::class];
        $this->Metadatos = $this->getTableLocator()->get('Metadatos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Metadatos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MetadatosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
