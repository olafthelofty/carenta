<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Nationalities Controller
 *
 * @property \App\Model\Table\NationalitiesTable $Nationalities
 */
class NationalitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $nationalities = $this->paginate($this->Nationalities);

        $this->set(compact('nationalities'));
        $this->set('_serialize', ['nationalities']);
    }

    /**
     * View method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nationality = $this->Nationalities->get($id, [
            'contain' => ['Employees']
        ]);

        $this->set('nationality', $nationality);
        $this->set('_serialize', ['nationality']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nationality = $this->Nationalities->newEntity();
        if ($this->request->is('post')) {
            $nationality = $this->Nationalities->patchEntity($nationality, $this->request->data);
            if ($this->Nationalities->save($nationality)) {
                $this->Flash->success(__('The nationality has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The nationality could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('nationality'));
        $this->set('_serialize', ['nationality']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nationality = $this->Nationalities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nationality = $this->Nationalities->patchEntity($nationality, $this->request->data);
            if ($this->Nationalities->save($nationality)) {
                $this->Flash->success(__('The nationality has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The nationality could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('nationality'));
        $this->set('_serialize', ['nationality']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nationality = $this->Nationalities->get($id);
        if ($this->Nationalities->delete($nationality)) {
            $this->Flash->success(__('The nationality has been deleted.'));
        } else {
            $this->Flash->error(__('The nationality could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
