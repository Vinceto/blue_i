<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SelectValues Controller
 *
 * @property \App\Model\Table\SelectValuesTable $SelectValues
 */
class SelectValuesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->SelectValues->find();
        $selectValues = $this->paginate($query);

        $this->set(compact('selectValues'));
    }

    /**
     * View method
     *
     * @param string|null $id Select Value id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $selectValue = $this->SelectValues->get($id, contain: []);
        $this->set(compact('selectValue'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $selectValue = $this->SelectValues->newEmptyEntity();
        if ($this->request->is('post')) {
            $selectValue = $this->SelectValues->patchEntity($selectValue, $this->request->getData());
            if ($this->SelectValues->save($selectValue)) {
                $this->Flash->success(__('The select value has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The select value could not be saved. Please, try again.'));
        }
        $this->set(compact('selectValue'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Select Value id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $selectValue = $this->SelectValues->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $selectValue = $this->SelectValues->patchEntity($selectValue, $this->request->getData());
            if ($this->SelectValues->save($selectValue)) {
                $this->Flash->success(__('The select value has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The select value could not be saved. Please, try again.'));
        }
        $this->set(compact('selectValue'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Select Value id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $selectValue = $this->SelectValues->get($id);
        if ($this->SelectValues->delete($selectValue)) {
            $this->Flash->success(__('The select value has been deleted.'));
        } else {
            $this->Flash->error(__('The select value could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
