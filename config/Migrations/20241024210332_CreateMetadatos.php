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
            'comment' => 'Nombre del Metadato'
        ])
        ->addColumn('label', 'string', [
            'limit' => 255,
            'null' => true,
            'comment' => 'Label del Metadato'
        ])
        ->addColumn('group_id', 'integer', [
            'null' => true,
            'signed' => false,
            'comment' => 'ID del grupo asignado al Metadato'
        ])
        ->addColumn('service_id', 'integer', [
            'null' => true,
            'signed' => false,
            'comment' => 'ID del servicio asignado  al Metadato'
        ])
        ->addColumn('tag', 'enum', [
            'values' => ['SELECT', 'INPUT', 'DATE'],
            'null' => false,
            'comment' => 'Tag del Metadato'
        ])
        ->addColumn('format_date', 'string', [
            'limit' => 255,
            'null' => true,
            'comment' => 'Formato para la un metadato con tag DATE'
        ])
        ->addColumn('select_data', 'integer', [
            'null' => true,
            'signed' => false,
            'comment' => 'ID del SelectedValue del Metadato'
        ])
        ->addColumn('visibility', 'boolean', [
            'default' => true,
            'null' => false,
            'comment' => 'Visibilidad del Metadato'
        ])
        ->addColumn('is_required', 'boolean', [
            'null' => false,
            'default' => false,
            'comment' => 'Es requerido del Metadato?'
        ])
        ->addColumn('created_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => true,
            'comment' => 'Fecha de creacion del Metadato'
        ])
        ->addColumn('updated_at', 'datetime', [
            'default' => null,
            'null' => true,
            'comment' => 'Fecha de modificacion del Metadato'
        ])
        ->addColumn('deleted_at', 'datetime', [
            'default' => null,
            'null' => true,
            'comment' => 'Fecha de soft deleted del Metadato'
        ])
        ->addPrimaryKey('id');

        // Índices y claves únicas
        $table  ->addIndex(['group_id'])
                ->addIndex(['select_data'])
                ->addIndex(['service_id']);

        $table->create();

        // Agregar la clave foránea para la columna role_id
        $this->table('metadatos')
            ->addForeignKey('group_id', 'idiem_group', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('select_data', 'select_values', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION',
            ])
            ->addForeignKey('service_id', 'idiem_service', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION',
            ])
            ->update();
    }
}
