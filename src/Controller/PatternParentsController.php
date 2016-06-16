<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

/**
 * PatternParents Controller
 *
 * @property \App\Model\Table\PatternParentsTable $PatternParents
 */
class PatternParentsController extends AppController
{
    
    public function newPattern()
    {
        
        $patternParentsTable = TableRegistry::get('PatternParents');
        $patternParent = $patternParentsTable->newEntity();
           
            $selectedstartdate = $this->request->query('selectedstartdate');
            $selectedenddate = $this->request->query('selectedenddate');
            $employee_id = $this->request->query('employee_id');
           
            $patternParent->parent_start = $selectedstartdate;
            $patternParent->parent_end = $selectedenddate;
            $patternParent->employee_id = $employee_id;
                  
            if($this->PatternParents->save($patternParent)){
                  $this->Flash->success(__('The pattern parent has been sasssved.'));
            }else{
             $this->Flash->error(__('The pattern parent could not be saved. Please, try again.'));
           }

    }    

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'Patterns']
        ];
        $patternParents = $this->paginate($this->PatternParents);

        $this->set(compact('patternParents'));
        $this->set('_serialize', ['patternParents']);
    }

    /**
     * View method
     *
     * @param string|null $id Pattern Parent id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $patternParent = $this->PatternParents->get($id, [
            'contain' => ['Patterns.Employees', 'Patterns.Resources', 'Patterns']
        ]);

        $this->set('patternParent', $patternParent);
        $this->set('_serialize', ['patternParent']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $patternParent = $this->PatternParents->newEntity();
        if ($this->request->is('post')) {
            $patternParent = $this->PatternParents->patchEntity($patternParent, $this->request->data);
            if ($this->PatternParents->save($patternParent)) {
                $this->Flash->success(__('The pattern parent has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pattern parent could not be saved. Please, try again.'));
            }
        }
        $employees = $this->PatternParents->Employees->find('list', ['limit' => 200]);
        $this->set(compact('patternParent', 'employees'));
        $this->set('_serialize', ['patternParent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pattern Parent id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $patternParent = $this->PatternParents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patternParent = $this->PatternParents->patchEntity($patternParent, $this->request->data);
            if ($this->PatternParents->save($patternParent)) {
                $this->Flash->success(__('The pattern parent has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pattern parent could not be saved. Please, try again.'));
            }
        }
        $employees = $this->PatternParents->Employees->find('list', ['limit' => 200]);
        $this->set(compact('patternParent', 'employees'));
        $this->set('_serialize', ['patternParent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pattern Parent id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $patternParent = $this->PatternParents->get($id);
        if ($this->PatternParents->delete($patternParent)) {
            $this->Flash->success(__('The pattern parent has been deleted.'));
        } else {
            $this->Flash->error(__('The pattern parent could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
