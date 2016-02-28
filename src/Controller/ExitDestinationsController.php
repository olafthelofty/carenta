<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExitDestinations Controller
 *
 * @property \App\Model\Table\ExitDestinationsTable $ExitDestinations
 */
class ExitDestinationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $exitDestinations = $this->paginate($this->ExitDestinations);

        $this->set(compact('exitDestinations'));
        $this->set('_serialize', ['exitDestinations']);
    }

    /**
     * View method
     *
     * @param string|null $id Exit Destination id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exitDestination = $this->ExitDestinations->get($id, [
            'contain' => []
        ]);

        $this->set('exitDestination', $exitDestination);
        $this->set('_serialize', ['exitDestination']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exitDestination = $this->ExitDestinations->newEntity();
        if ($this->request->is('post')) {
            $exitDestination = $this->ExitDestinations->patchEntity($exitDestination, $this->request->data);
            if ($this->ExitDestinations->save($exitDestination)) {
                $this->Flash->success(__('The exit destination has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exit destination could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('exitDestination'));
        $this->set('_serialize', ['exitDestination']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exit Destination id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exitDestination = $this->ExitDestinations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exitDestination = $this->ExitDestinations->patchEntity($exitDestination, $this->request->data);
            if ($this->ExitDestinations->save($exitDestination)) {
                $this->Flash->success(__('The exit destination has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exit destination could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('exitDestination'));
        $this->set('_serialize', ['exitDestination']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exit Destination id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exitDestination = $this->ExitDestinations->get($id);
        if ($this->ExitDestinations->delete($exitDestination)) {
            $this->Flash->success(__('The exit destination has been deleted.'));
        } else {
            $this->Flash->error(__('The exit destination could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
