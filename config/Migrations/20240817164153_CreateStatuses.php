<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateStatuses extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('statuses');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ])
        ->addPrimaryKey('id')
        ->addIndex(['name'], ['unique' => true]);
        $table->create();
    }
}
