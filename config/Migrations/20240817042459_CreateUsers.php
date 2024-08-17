<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        
        $table->addColumn('username', 'string', [
                'limit' => 150,
                'null' => false,
                'comment' => 'Nombre de usuario único'
            ])
            ->addColumn('email', 'string', [
                'limit' => 255,
                'null' => false,
                'comment' => 'Correo electrónico único'
            ])
            ->addColumn('password', 'string', [
                'limit' => 255,
                'null' => false,
                'comment' => 'Contraseña del usuario'
            ])
            ->addColumn('first_name', 'string', [
                'limit' => 100,
                'null' => true,
                'comment' => 'Nombre del usuario'
            ])
            ->addColumn('last_name', 'string', [
                'limit' => 100,
                'null' => true,
                'comment' => 'Apellido del usuario'
            ])
            ->addColumn('role', 'enum', [
                'values' => ['user', 'admin'],
                'default' => 'user',
                'comment' => 'Rol del usuario'
            ])
            ->addColumn('status', 'enum', [
                'values' => ['active', 'inactive'],
                'default' => 'active',
                'comment' => 'Estado del usuario'
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false,
                'comment' => 'Fecha y hora de creación'
            ])
            ->addColumn('updated_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'null' => true,
                'comment' => 'Fecha y hora de la última actualización'
            ])
            ->addColumn('deleted_at', 'datetime', [
                'null' => true,
                'comment' => 'Fecha y hora de eliminación lógica (soft delete)'
            ]);

        // Índices y claves únicas
        $table->addIndex(['username'], ['unique' => true])
              ->addIndex(['email'], ['unique' => true]);

        // Crear la tabla
        $table->create();
    }
}
