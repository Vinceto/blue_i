<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRoles extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('roles');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ])
        ->addPrimaryKey('id')
        ->addIndex(['name'], ['unique' => true]);
        $table->create();
    }
}
