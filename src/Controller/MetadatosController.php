<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Http\Exception\NotFoundException;
use Exception;
/**
 * Metadatos Controller
 *
 * @property \App\Model\Table\MetadatosTable $Metadatos
 */
class MetadatosController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Cargar el componente para conexión dinámica
        $this->loadComponent('DynamicDatabase');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Metadatos->find();
        $metadatos = $this->paginate($query);

        $this->set(compact('metadatos'));

        // Llamar a operarConDatos
        $data = $this->operarConDatos('IDIEM_FIRMA', 'METADATOS');

        // Si no hay datos, la variable $data será null y no se mostrará nada
        if ($data === null) {
            $this->set('data', []); // O define un valor por defecto para evitar errores en la vista
        } else {
            $this->set(compact('data'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Metadato id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $metadato = $this->Metadatos->get($id, contain: []);
        $this->set(compact('metadato'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $metadato = $this->Metadatos->newEmptyEntity();
        if ($this->request->is('post')) {
            $metadato = $this->Metadatos->patchEntity($metadato, $this->request->getData());
            if ($this->Metadatos->save($metadato)) {
                $this->Flash->success(__('The metadato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The metadato could not be saved. Please, try again.'));
        }
        $this->set(compact('metadato'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Metadato id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $metadato = $this->Metadatos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $metadato = $this->Metadatos->patchEntity($metadato, $this->request->getData());
            if ($this->Metadatos->save($metadato)) {
                $this->Flash->success(__('The metadato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The metadato could not be saved. Please, try again.'));
        }
        $this->set(compact('metadato'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Metadato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $metadato = $this->Metadatos->get($id);
        if ($this->Metadatos->delete($metadato)) {
            $this->Flash->success(__('The metadato has been deleted.'));
        } else {
            $this->Flash->error(__('The metadato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function operarConDatos($database = 'IDIEM_FIRMA', $table = 'METADATOS', $customQuery = null)
{
    try {
        // Usar el componente para ejecutar la consulta
        $results = $this->DynamicDatabase->executeQuery($database, $table, $customQuery);

        // Validar si no se encontraron resultados
        if (empty($results)) {
            $this->Flash->warning(__('No se encontraron datos en la tabla: ' . $table));
            return null; // No redirigir, solo retornar null
        }

        // Enviar los resultados a la vista
        $this->set(compact('results'));
        return $results; // Retornar los resultados si todo está bien
    } catch (NotFoundException $e) {
        $this->Flash->error(__('Error: ' . $e->getMessage()));
        return null; // No redirigir, solo retornar null
    } catch (Exception $e) {
        $this->Flash->error(__('Ocurrió un error inesperado: ' . $e->getMessage()));
        return null; // No redirigir, solo retornar null
    }
}

}
