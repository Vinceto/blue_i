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
                'host' => '172.17.92.211',  // Cambia esto si tu servidor es otro
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
            //Log::write('error', 'Error en la conexión: ' . $e->getMessage());
            throw new Exception('No se pudo conectar a la base de datos ' . $database);
        } catch (Exception $e) {
            //Log::write('error', 'Error en la conexión: ' . $e->getMessage());
            //var_dump(''. $e->getMessage() .'');//C:\wamp64\www\blue_i\src\Controller\Component\DynamicDatabaseComponent.php:44:string 'Cannot reconfigure existing key `dynamic`.' (length=42)
            //exit();
            throw new Exception('Error general al conectar a la base de datos.');
        }
    }

    /*
        ejemplos de bind values:
         ['MET_OBR_GRU_ID', 'LIKE', $group_id]
        ,['OTRA_COLUMNA', '=', 'valor_a_comparar']
        ,['COLUMN_IN', 'IN', ['value1', 'value2', 'value3']] // Ejemplo de uso de IN
        ,['COLUMN_BETWEEN', 'BETWEEN', ['valor_inferior', 'valor_superior']], // Ejemplo de uso de BETWEEN
    */
    public function executeQuery($database, $table, $bindValues = [])
    {
        // Conectar a la base de datos especificada
        $db = $this->connectTo($database);

        // Construir la consulta base
        $query = "SELECT * FROM " . $table . " WHERE 1 = 1"; // Esto permite agregar condiciones dinámicamente

        // Agregar las condiciones de los parámetros dinámicamente
        $params = [];
        if (!empty($bindValues)) {
            foreach ($bindValues as $criteria) {
                // Cada $criteria debería ser un array con ['column', 'operator', 'value']
                list($column, $operator, $value) = $criteria;
                
                switch ($operator) {
                    case 'LIKE':
                        $query .= " AND " . $column . " LIKE ?";
                        $params[] = $value . '%'; // Para LIKE, puedes agregar '%' o no dependiendo del uso
                        break;
                    case 'NOT LIKE':
                        $query .= " AND " . $column . " NOT LIKE ?";
                        $params[] = $value . '%';
                        break;
                    case '=':
                        $query .= " AND " . $column . " = ?";
                        $params[] = $value;
                        break;
                    case '!=':
                        $query .= " AND " . $column . " != ?";
                        $params[] = $value;
                        break;
                    case 'IN':
                        $placeholders = implode(',', array_fill(0, count($value), '?'));
                        $query .= " AND " . $column . " IN ($placeholders)";
                        $params = array_merge($params, $value);
                        break;
                    case 'NOT IN':
                        $placeholders = implode(',', array_fill(0, count($value), '?'));
                        $query .= " AND " . $column . " NOT IN ($placeholders)";
                        $params = array_merge($params, $value);
                        break;
                    case 'BETWEEN':
                        $query .= " AND " . $column . " BETWEEN ? AND ?";
                        $params[] = $value[0];
                        $params[] = $value[1];
                        break;
                    case 'IS NULL':
                        $query .= " AND " . $column . " IS NULL";
                        break;
                    case 'IS NOT NULL':
                        $query .= " AND " . $column . " IS NOT NULL";
                        break;
                    default:
                        throw new Exception('Operador no soportado: ' . $operator);
                }
            }
        }
        try {
            // Ejecutar la consulta con parámetros
            $stmt = $db->execute($query, $params);
            $results = $stmt->fetchAll('assoc'); // Obtener resultados como array asociativo
            return $results;
        } catch (Exception $e) {
            Log::write('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
            throw new Exception('Error al ejecutar la consulta en la tabla ' . $table);
        }
    }


}