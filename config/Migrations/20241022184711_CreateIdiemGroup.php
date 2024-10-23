<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateIdiemGroup extends AbstractMigration
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
        $table = $this->table('idiem_group');
        $table->addColumn('valor', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
            'comment' => 'Nombre compuesto para el grupo'
        ]);
        $table  ->addPrimaryKey(['id'])
                ->addIndex(['valor'], ['unique' => true]);
        $table->create();
    }
}