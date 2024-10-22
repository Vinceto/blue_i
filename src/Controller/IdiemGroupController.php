<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * IdiemGroup Controller
 *
 * @property \App\Model\Table\IdiemGroupTable $IdiemGroup
 */
class IdiemGroupController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->IdiemGroup->find();
        $idiemGroup = $this->paginate($query);

        $this->set(compact('idiemGroup'));
    }

    /**
     * View method
     *
     * @param string|null $id Idiem Group id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $idiemGroup = $this->IdiemGroup->get($id, contain: []);
        $this->set(compact('idiemGroup'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $idiemGroup = $this->IdiemGroup->newEmptyEntity();
        if ($this->request->is('post')) {
            $idiemGroup = $this->IdiemGroup->patchEntity($idiemGroup, $this->request->getData());
            if ($this->IdiemGroup->save($idiemGroup)) {
                $this->Flash->success(__('The idiem group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The idiem group could not be saved. Please, try again.'));
        }
        $this->set(compact('idiemGroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Idiem Group id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $idiemGroup = $this->IdiemGroup->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $idiemGroup = $this->IdiemGroup->patchEntity($idiemGroup, $this->request->getData());
            if ($this->IdiemGroup->save($idiemGroup)) {
                $this->Flash->success(__('The idiem group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The idiem group could not be saved. Please, try again.'));
        }
        $this->set(compact('idiemGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Idiem Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $idiemGroup = $this->IdiemGroup->get($id);
        if ($this->IdiemGroup->delete($idiemGroup)) {
            $this->Flash->success(__('The idiem group has been deleted.'));
        } else {
            $this->Flash->error(__('The idiem group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
