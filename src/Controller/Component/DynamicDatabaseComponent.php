<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\MissingDatasourceConfigException;
use Cake\Log\Log;
use Exception;

class DynamicDatabaseComponent extends Component
{
    public function connectTo(string $database)
    {
        try {
            // Configurar la conexión dinámica
            ConnectionManager::setConfig('dynamic', [
                'className' => 'Cake\Database\Connection',
                'driver' => 'Cake\Database\Driver\Mysql',
                'persistent' => false,
                'host' => '172.17.83.15',  // Cambia esto si tu servidor es otro
                'username' => 'DevDBAIntranet',
                'password' => 'nXBXTCwxsen4t32W',
                'database' => $database, // Base de datos dinámica
                'encoding' => 'utf8mb4',
                'timezone' => 'UTC',
                'flags' => [],
                'cacheMetadata' => true,
                'log' => false,
                'quoteIdentifiers' => false,
                'url' => env('DATABASE_URL_LOCAL', null),
            ]);

            // Intentar conectar
            $db = ConnectionManager::get('dynamic');

            return $db;
        } catch (MissingDatasourceConfigException $e) {
            Log::write('error', 'Error en la conexión: ' . $e->getMessage());
            throw new Exception('No se pudo conectar a la base de datos ' . $database);
        } catch (Exception $e) {
            Log::write('error', 'Error en la conexión: ' . $e->getMessage());
            throw new Exception('Error general al conectar a la base de datos.');
        }
    }

    public function executeQuery($database, $table, $customQuery = null)
    {
        // Conectar a la base de datos especificada
        $db = $this->connectTo($database);

        // Si hay una consulta personalizada, usarla
        if ($customQuery !== null) {
            $query = $customQuery;
        } else {
            // Consulta por defecto para seleccionar todos los datos de la tabla
            $query = $db->newQuery()->select('*')->from($table);
        }

        try {
            // Ejecutar la consulta
            $results = $query->execute()->fetchAll('assoc');
            return $results;
        } catch (Exception $e) {
            Log::write('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
            throw new Exception('Error al ejecutar la consulta en la tabla ' . $table);
        }
    }
}