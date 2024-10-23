<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSelectValues extends AbstractMigration
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
        $table = $this->table('select_values');
        $table->addColumn('select_key', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
            'comment' => 'Key del Select'
        ]);
        $table->addColumn('select_value', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
            'comment' => 'Value del Select'
        ]);
        $table  ->addPrimaryKey(['id'])
                ->addIndex(['select_value'], ['unique' => true]);
        $table->create();
    }
}
