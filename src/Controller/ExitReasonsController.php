<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExitReasons Controller
 *
 * @property \App\Model\Table\ExitReasonsTable $ExitReasons
 */
class ExitReasonsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $exitReasons = $this->paginate($this->ExitReasons);

        $this->set(compact('exitReasons'));
        $this->set('_serialize', ['exitReasons']);
    }

    /**
     * View method
     *
     * @param string|null $id Exit Reason id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exitReason = $this->ExitReasons->get($id, [
            'contain' => []
        ]);

        $this->set('exitReason', $exitReason);
        $this->set('_serialize', ['exitReason']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exitReason = $this->ExitReasons->newEntity();
        if ($this->request->is('post')) {
            $exitReason = $this->ExitReasons->patchEntity($exitReason, $this->request->data);
            if ($this->ExitReasons->save($exitReason)) {
                $this->Flash->success(__('The exit reason has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exit reason could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('exitReason'));
        $this->set('_serialize', ['exitReason']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exit Reason id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exitReason = $this->ExitReasons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exitReason = $this->ExitReasons->patchEntity($exitReason, $this->request->data);
            if ($this->ExitReasons->save($exitReason)) {
                $this->Flash->success(__('The exit reason has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exit reason could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('exitReason'));
        $this->set('_serialize', ['exitReason']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exit Reason id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exitReason = $this->ExitReasons->get($id);
        if ($this->ExitReasons->delete($exitReason)) {
            $this->Flash->success(__('The exit reason has been deleted.'));
        } else {
            $this->Flash->error(__('The exit reason could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
