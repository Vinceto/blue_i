<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MetadatosFixture
 */
class MetadatosFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'label' => 'Lorem ipsum dolor sit amet',
                'group_id' => 1,
                'service_id' => 1,
                'tag' => 'Lorem ipsum dolor sit amet',
                'selectData' => '',
                'visibility' => 1,
                'is_required' => 1,
                'created_at' => '2024-10-21 18:38:22',
                'updated_at' => '2024-10-21 18:38:22',
                'deleted_at' => '2024-10-21 18:38:22',
            ],
        ];
        parent::init();
    }
}
