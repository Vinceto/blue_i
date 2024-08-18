<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * NavBarItems Controller
 *
 * @property \App\Model\Table\NavBarItemsTable $NavBarItems
 */
class NavBarItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->NavBarItems->find()
            ->contain(['Roles']);
        $navBarItems = $this->paginate($query);

        $this->set(compact('navBarItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Nav Bar Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $navBarItem = $this->NavBarItems->get($id, contain: ['Roles']);
        $this->set(compact('navBarItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $navBarItem = $this->NavBarItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $navBarItem = $this->NavBarItems->patchEntity($navBarItem, $this->request->getData());
            if ($this->NavBarItems->save($navBarItem)) {
                $this->Flash->success(__('The nav bar item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nav bar item could not be saved. Please, try again.'));
        }
        $roles = $this->NavBarItems->Roles->find('list', limit: 200)->all();
        $this->set(compact('navBarItem', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Nav Bar Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $navBarItem = $this->NavBarItems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $navBarItem = $this->NavBarItems->patchEntity($navBarItem, $this->request->getData());
            if ($this->NavBarItems->save($navBarItem)) {
                $this->Flash->success(__('The nav bar item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nav bar item could not be saved. Please, try again.'));
        }
        $roles = $this->NavBarItems->Roles->find('list', limit: 200)->all();
        $this->set(compact('navBarItem', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Nav Bar Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $navBarItem = $this->NavBarItems->get($id);
        if ($this->NavBarItems->delete($navBarItem)) {
            $this->Flash->success(__('The nav bar item has been deleted.'));
        } else {
            $this->Flash->error(__('The nav bar item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
