<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'register']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Flash->success(__('Bienvenido'));
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Home',//pendiente
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('El usuario o la contraseña son invalidos!'));
        }
    }

    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        
        // Si la petición es de tipo POST, procesamos los datos
        if ($this->request->is('post')) {
            // Parchamos los datos al nuevo usuario
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            if ($user->role_id == 1) {
                $adminCount = $this->Users->find()->where(['role_id' => 1])->count();
                if ($adminCount > 0) {
                    // Mostrar error si ya existe un usuario con el rol de Admin
                    $this->Flash->error(__('Ya existe un usuario con el rol Admin.'));
                    return;
                }
            }

            // Agregar el estatus de activo (status_id = 1) al nuevo usuario
            $user->status_id = 1;
            if ($user->status_id !== 1) {
                $this->Flash->error(__('Error al asignar el estado activo al usuario.'));
                return;
            }
            // Intentamos guardar el usuario
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuario registrado exitosamente.'));
                
                // Redireccionamos al login después del registro
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('El usuario no pudo ser registrado. Por favor, inténtelo nuevamente.'));
        }
        
        // Cargamos las listas de roles y estados
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->all();
        $statuses = $this->Users->Statuses->find('list', ['limit' => 200])->all();
        
        // Enviamos las variables a la vista
        $this->set(compact('user', 'roles', 'statuses'));
    }


    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find()
            ->contain(['Roles', 'Statuses']);
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: ['Roles', 'Statuses']);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(){
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('No se pudo guardar el usuario. Inténtalo de nuevo.'));
        }

        // Obtener la lista de roles y estados para los selects del formulario
        $roles = $this->Users->Roles->find('list', limit: 200)->all();
        $statuses = $this->Users->Statuses->find('list', limit: 200)->all();
        $this->set(compact('user', 'roles', 'statuses'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->updated_at = new \Cake\I18n\FrozenTime();
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario fue modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se puede modificar el usuario. Por favor, intente nuevamente.'));
        }
        $roles = $this->Users->Roles->find('list', limit: 200)->all();
        $statuses = $this->Users->Statuses->find('list', limit: 200)->all();
        $this->set(compact('user', 'roles', 'statuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
