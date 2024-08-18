<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddForeignKeyToNavBarItems extends AbstractMigration
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
        $table = $this->table('nav_bar_items')
                ->addForeignKey('role_id', 'roles', 'id', [
                    'delete' => 'SET_NULL',
                    'update' => 'NO_ACTION',
                ]);
        $table->update();
    }
}
