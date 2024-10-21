<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMetadatos extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('metadatos');
        $table->addColumn('name', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('label', 'string', [
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('group_id', 'integer', [
            'null' => true,
            'signed' => false,
            'comment' => 'ID del grupo asignado'
        ])
        ->addColumn('service_id', 'integer', [
            'null' => true,
            'signed' => false,
            'comment' => 'ID del servicio asignado'
        ])
        ->addColumn('tag', 'enum', [
            'values' => ['SELECT', 'INPUT', 'DATE'],
            'null' => false,
        ])
        ->addColumn('selectData', 'json', [
            'null' => true,
        ])
        ->addColumn('visibility', 'boolean', [
            'default' => true,
            'null' => false,
        ])
        ->addColumn('is_required', 'boolean', [
            'null' => false,
            'default' => false,
        ])
        ->addColumn('created_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => true,
        ])
        ->addColumn('updated_at', 'datetime', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('deleted_at', 'datetime', [
            'default' => null,
            'null' => true,
        ])
        ->addPrimaryKey('id');
        $table->create();
    }
}
