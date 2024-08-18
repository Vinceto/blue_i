<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateNavBarItems extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('nav_bar_items');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ])
        ->addColumn('url', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
            'comment' => 'Url asignada'
        ])
        ->addColumn('role_id', 'integer', [
            'null' => true,
            'signed' => false,
            'comment' => 'ID del rol asignado'
        ])
        ->addPrimaryKey('id')
        ->addIndex(['name'], ['unique' => true])
        ->addIndex(['role_id'])
        ->create();
    }
}