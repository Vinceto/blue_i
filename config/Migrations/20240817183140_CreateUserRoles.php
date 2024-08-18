<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUserRoles extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user_roles');
        $table->addColumn('user_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('role_id', 'integer', ['null' => false, 'signed' => false])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('role_id', 'roles', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->addIndex(['user_id', 'role_id'], ['unique' => true, 'name' => 'idx_user_role_unique'])
            ->create();
    }
}
