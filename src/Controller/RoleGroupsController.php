<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RoleGroups Controller
 *
 * @property \App\Model\Table\RoleGroupsTable $RoleGroups
 */
class RoleGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $roleGroups = $this->paginate($this->RoleGroups);

        $this->set(compact('roleGroups'));
        $this->set('_serialize', ['roleGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Role Group id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roleGroup = $this->RoleGroups->get($id, [
            'contain' => ['Roles']
        ]);

        $this->set('roleGroup', $roleGroup);
        $this->set('_serialize', ['roleGroup']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roleGroup = $this->RoleGroups->newEntity();
        if ($this->request->is('post')) {
            $roleGroup = $this->RoleGroups->patchEntity($roleGroup, $this->request->data);
            if ($this->RoleGroups->save($roleGroup)) {
                $this->Flash->success(__('The role group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('roleGroup'));
        $this->set('_serialize', ['roleGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role Group id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roleGroup = $this->RoleGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roleGroup = $this->RoleGroups->patchEntity($roleGroup, $this->request->data);
            if ($this->RoleGroups->save($roleGroup)) {
                $this->Flash->success(__('The role group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('roleGroup'));
        $this->set('_serialize', ['roleGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roleGroup = $this->RoleGroups->get($id);
        if ($this->RoleGroups->delete($roleGroup)) {
            $this->Flash->success(__('The role group has been deleted.'));
        } else {
            $this->Flash->error(__('The role group could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
