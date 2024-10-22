<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SelectValuesFixture
 */
class SelectValuesFixture extends TestFixture
{
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
                'select_key' => 'Lorem ipsum dolor sit amet',
                'select_value' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
