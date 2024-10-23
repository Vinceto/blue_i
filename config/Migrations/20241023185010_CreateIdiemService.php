<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateIdiemService extends AbstractMigration
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
        $table = $this->table('idiem_service');
        $table->addColumn('service_key', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
            'comment' => 'Key del servicio'
        ]);
        $table->addColumn('service_value', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
            'comment' => 'Value del servicio'
        ]);
        $table->create();
    }
}
