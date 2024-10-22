<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
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
        $data = $this->obtenerMetadatosIntranetIdiem();

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

    public function obtenerMetadatosIntranetIdiem()
    {
        $listadoMetadatos = array();
        try {
            // Inicializar la base de datos y tabla
            $database = 'IDIEM_FIRMA';
            $table = 'METADATOS';
            $group_id = 'idiem.hormigones.muestreo.laboratorio'; // Debe cargarse dinámicamente después
            $bindValues = [
                ['MET_OBR_GRU_ID', 'LIKE', $group_id]
            ];

            $results = $this->DynamicDatabase->executeQuery($database, $table, []);
            
            // return $results;
            foreach ($results as $key => $value) {
                $a = array('DOC_METADATOS' => $value['MET_METADATOS']);
                $b = $this->normDoc($a);
                $listadoMetadatos[$value['MET_OBR_GRU_ID']] = $b['metadatos'];
            }
            //var_dump($listadoMetadatos);
            if (empty($listadoMetadatos)) {
                $this->Flash->warning(__('No se encontraron datos en la tabla: ' . $listadoMetadatos));
                return null;
            } else {
                $this->Flash->success(__('Se encontraron ' . count($listadoMetadatos) . ' grupos y sus metadatos'));
                
                // Cargar el modelo de IdemGroup usando fetchTable o TableRegistry
                $this->IdiemGroup = $this->fetchTable('IdiemGroup'); // Alternativa: TableRegistry::getTableLocator()->get('IdiemGroup');
                $this->SelectValues = $this->fetchTable('SelectValues');

                // Aquí recorremos el array de metadatos encontrados e insertamos en el modelo Metadatos
                foreach ($listadoMetadatos as $groupIdString => $metadatos) {
                    if($groupIdString == '' && empty($metadatos)){
                        break;
                    }
                    // Verificar si el grupo ya existe en la tabla idiem_group
                    $group = $this->IdiemGroup->find()
                        ->where(['valor' => $groupIdString])
                        ->first();

                    // Si el grupo no existe, crearlo
                    if (!$group) {
                        $newGroup = $this->IdiemGroup->newEntity([
                            'valor' => $groupIdString
                        ]);

                        if ($this->IdiemGroup->save($newGroup)) {
                            $groupId = $newGroup->id; // Guardar el ID numérico recién creado
                            //$this->Flash->success(__('Grupo creado: ' . $groupIdString));
                        } else {
                            var_dump($groupIdString);
                            var_dump($metadatos);
                            $this->Flash->error(__('Error al crear el grupo: ' . $groupIdString));
                            continue; // Si hay un error al crear el grupo, pasar al siguiente
                        }
                    } else {
                        $groupId = $group->id; // Si el grupo ya existe, usar su ID numérico
                    }

                    // Ahora procesamos los metadatos
                    foreach ($metadatos as $name => $label) {
                        // Verificar si el metadato ya existe en la base de datos
                        $existingMetadato = $this->Metadatos->find()
                            ->where(['name' => $name, 'group_id' => $groupId]) // Usamos el ID numérico
                            ->first();

                        if (!$existingMetadato) {
                            //si la opcion label es un array, crear la relacion con SelecValues
                            if(is_array($label)){
                                //var_dump($label);
                                foreach ($label as $keyLabel => $labelValue) {
                                    $existingSelectValues = $this->SelectValues->find()
                                        ->where(['select_key' => $keyLabel, 'select_value' => $labelValue]) // Usamos el ID numérico
                                        ->first();
                                    if (!$existingSelectValues) {
                                        //$this->Flash->success(__('El SelectedValue "' . $labelValue . '" sera insertado en el siguiente episodio.'));
                                        $selectValuesEntity = $this->SelectValues->newEntity([
                                            'select_key'       => $keyLabel,
                                            'select_value'      => $labelValue
                                        ]);

                                        // Intentar guardar el SelectValues en la base de datos
                                        if (!$this->SelectValues->save($selectValuesEntity)) {
                                            $this->Flash->error(__('No se pudo guardar el SelectValues: ' . $name));
                                        }
                                    }else{
                                        //$this->Flash->info(__('El SelectedValue "' . $labelValue . '" ya existe y no fue insertado.'));
                                    }
                                }
                            }
                           
                            // Si no existe, crear una nueva entidad Metadato
                            $metadatoEntity = $this->Metadatos->newEntity([
                                'name'       => $name,
                                //'label'      => $label,
                                'label'      => (is_array($label)) ? $name : $label,
                                'group_id'   => $groupId, // Asignar el ID numérico del grupo
                                'service_id' => null, // Si es necesario, puedes asignar otro valor aquí
                                'tag'        => (is_array($label)) ? 'SELECT' : 'INPUT', // Puedes adaptar esto según tu lógica
                                'visibility' => true, // Valor por defecto, puede cambiar según la lógica
                                'is_required' => false, // Valor por defecto, puede cambiar según la lógica
                                'created_at' => date('Y-m-d H:i:s')
                            ]);

                            // Intentar guardar el metadato en la base de datos
                            if (!$this->Metadatos->save($metadatoEntity)) {
                                //var_dump($metadatos);
                                $this->Flash->error(__('No se pudo guardar el metadato: ' . $name));
                            }
                        } else {
                            //$this->Flash->info(__('El metadato "' . $name . '" ya existe en el grupo ' . $groupIdString . ' y no fue insertado.'));
                        }
                    }
                }

                //$this->Flash->success(__('Todos los metadatos no existentes fueron guardados exitosamente.'));
            }

        } catch (NotFoundException $e) {
            $this->Flash->error(__('Error: ' . $e->getMessage()));
            return null; // No redirigir, solo retornar null
        } catch (Exception $e) {
            $this->Flash->error(__('Ocurrió un error inesperado: ' . $e->getMessage()));
            return null; // No redirigir, solo retornar null
        }
    }


    public function normDoc( $doc ) {
        if( empty( $doc ) ) return;

        $doc['metadatos'] = array();

        if( $doc['DOC_METADATOS'] ) {
            eval( '$doc["metadatos"] = '.$doc['DOC_METADATOS'].';' );
        }
        return $doc;
    }
    public function extraerMetadatos($array) {
        $homologado = [];

        if (isset($array['metadatos']) && is_array($array['metadatos'])) {
            foreach ($array['metadatos'] as $key => $value) {
                $homologado[] = [
                    'name'  => $key
                    ,'label' => $value
                ];
            }
        }

        return $homologado;
    }
}