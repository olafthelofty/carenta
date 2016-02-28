<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DayParts Controller
 *
 * @property \App\Model\Table\DayPartsTable $DayParts
 */
class DayPartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $dayParts = $this->paginate($this->DayParts);

        $this->set(compact('dayParts'));
        $this->set('_serialize', ['dayParts']);
    }

    /**
     * View method
     *
     * @param string|null $id Day Part id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dayPart = $this->DayParts->get($id, [
            'contain' => ['Shifts']
        ]);

        $this->set('dayPart', $dayPart);
        $this->set('_serialize', ['dayPart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dayPart = $this->DayParts->newEntity();
        if ($this->request->is('post')) {
            $dayPart = $this->DayParts->patchEntity($dayPart, $this->request->data);
            if ($this->DayParts->save($dayPart)) {
                $this->Flash->success(__('The day part has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The day part could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dayPart'));
        $this->set('_serialize', ['dayPart']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Day Part id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dayPart = $this->DayParts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dayPart = $this->DayParts->patchEntity($dayPart, $this->request->data);
            if ($this->DayParts->save($dayPart)) {
                $this->Flash->success(__('The day part has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The day part could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dayPart'));
        $this->set('_serialize', ['dayPart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Day Part id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dayPart = $this->DayParts->get($id);
        if ($this->DayParts->delete($dayPart)) {
            $this->Flash->success(__('The day part has been deleted.'));
        } else {
            $this->Flash->error(__('The day part could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
