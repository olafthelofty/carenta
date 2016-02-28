<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ethnicities Controller
 *
 * @property \App\Model\Table\EthnicitiesTable $Ethnicities
 */
class EthnicitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $ethnicities = $this->paginate($this->Ethnicities);

        $this->set(compact('ethnicities'));
        $this->set('_serialize', ['ethnicities']);
    }

    /**
     * View method
     *
     * @param string|null $id Ethnicity id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ethnicity = $this->Ethnicities->get($id, [
            'contain' => []
        ]);

        $this->set('ethnicity', $ethnicity);
        $this->set('_serialize', ['ethnicity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ethnicity = $this->Ethnicities->newEntity();
        if ($this->request->is('post')) {
            $ethnicity = $this->Ethnicities->patchEntity($ethnicity, $this->request->data);
            if ($this->Ethnicities->save($ethnicity)) {
                $this->Flash->success(__('The ethnicity has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ethnicity could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ethnicity'));
        $this->set('_serialize', ['ethnicity']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ethnicity id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ethnicity = $this->Ethnicities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ethnicity = $this->Ethnicities->patchEntity($ethnicity, $this->request->data);
            if ($this->Ethnicities->save($ethnicity)) {
                $this->Flash->success(__('The ethnicity has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ethnicity could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ethnicity'));
        $this->set('_serialize', ['ethnicity']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ethnicity id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ethnicity = $this->Ethnicities->get($id);
        if ($this->Ethnicities->delete($ethnicity)) {
            $this->Flash->success(__('The ethnicity has been deleted.'));
        } else {
            $this->Flash->error(__('The ethnicity could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
