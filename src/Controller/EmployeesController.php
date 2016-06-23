<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
// use Cake\Routing\Router;
// use Cake\View\Helper\UrlHelper;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class EmployeesController extends AppController
{

public function search() 
    {
        
        $employees = TableRegistry::get('Employees');

        if ($this->request->is('ajax')) {
            
            $this->autoRender = false;            
            $name = $this->request->query('term');            

            $results = $employees->find('all')
                ->where(['Employees.first_name LIKE ' => '%' . $name . '%'])
                ->orWhere(['Employees.last_name LIKE ' => '%' . $name . '%']);
            
            $resultArr = array();
            foreach($results as $result) {
               $resultArr[] = ['label' =>$result['first_name'] . ' ' . $result['last_name'], 'value' => $result['id'] ];
            }
            echo json_encode($resultArr);              
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
            'contain' => ['Counties', 'ExitReasons', 'Roles', 'Nationalities', 'Ethnicities', 'ExitDestinations']
        ];
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
        $this->set('_serialize', ['employees']);
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        // if(!$this->request->query('id')) {$employee_id = 22;} else {
        //     $employee_id = $this->request->query('ide');
        // 

        if($this->request->query('id')) {
            $id = $this->request->query('id');
            $search = true;
            //$id = 23;
            }

        //$id = 24;

        $employee = $this->Employees->get($id, [
                'contain' => [
                    'Counties', 
                    'ExitReasons', 
                    'Roles', 
                    'Nationalities', 
                    'Ethnicities', 
                    'ExitDestinations', 
                    'Patterns', 
                    'PatternParents', //?
                    'PatternParents.Patterns',
                    'PatternParents.Patterns.Events',
                    'PatternParents.Patterns.Resources.Parent',
                    'PatternParents.Patterns.Resources.Children', 
                    'Patterns.Resources.Parent', //?
                    'Patterns.Resources.Children' //?
                ]
            ]);

        $this->set(compact('employee'));
        $this->set('_serialize', ['employee']); 

// if($this->search == true) {
//     echo 'fff';
//         $this->redirect(array('action' => "view", $id));
// }

        // $this->redirect([
        //     'controller' => 'Employees', 
        //     'action' => 'view',
        //     $id
            
  
        // ]);

    }
    
    public function viewAll($id = null)
    {
                
        // Set the layout.
        //$this->viewBuilder()->layout('fullscreen');
        
        $this->paginate = [
            'contain' => ['Counties', 'ExitReasons', 'Roles', 'Nationalities', 'Ethnicities', 'ExitDestinations', 'Patterns', 'Patterns.Resources'],
            'limit' => 1
        ];
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
        $this->set('_serialize', ['employees']);        
    }    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        $counties = $this->Employees->Counties->find('list', ['limit' => 200]);
        $exitReasons = $this->Employees->ExitReasons->find('list', ['limit' => 200]);
        $roles = $this->Employees->Roles->find('list', ['limit' => 200]);
        $nationalities = $this->Employees->Nationalities->find('list', ['limit' => 200]);
        $ethnicities = $this->Employees->Ethnicities->find('list', ['limit' => 200]);
        $exitDestinations = $this->Employees->ExitDestinations->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'counties', 'exitReasons', 'roles', 'nationalities', 'ethnicities', 'exitDestinations'));
        $this->set('_serialize', ['employee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        $counties = $this->Employees->Counties->find('list', ['limit' => 200]);
        $exitReasons = $this->Employees->ExitReasons->find('list', ['limit' => 200]);
        $roles = $this->Employees->Roles->find('list', ['limit' => 200]);
        $nationalities = $this->Employees->Nationalities->find('list', ['limit' => 200]);
        $ethnicities = $this->Employees->Ethnicities->find('list', ['limit' => 200]);
        $exitDestinations = $this->Employees->ExitDestinations->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'counties', 'exitReasons', 'roles', 'nationalities', 'ethnicities', 'exitDestinations'));
        $this->set('_serialize', ['employee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
