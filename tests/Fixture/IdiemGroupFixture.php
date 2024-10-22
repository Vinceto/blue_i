<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IdiemGroupFixture
 */
class IdiemGroupFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'idiem_group';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'valor' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
