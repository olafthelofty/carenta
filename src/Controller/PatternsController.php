<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

/**
 * Patterns Controller
 *
 * @property \App\Model\Table\PatternsTable $Patterns
 */
class PatternsController extends AppController
{

  // sets up a feed for calendar events, consumed as json
    public function feed() {

    } 

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'Resources', 'PatternParents']
        ];
        $patterns = $this->paginate($this->Patterns);

        $this->set(compact('patterns'));
        $this->set('_serialize', ['patterns']);
    }

    /**
     * View method
     *
     * @param string|null $id Pattern id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pattern = $this->Patterns->get($id, [
            'contain' => ['Employees', 'Resources']
        ]);

        $this->set('pattern', $pattern);
        $this->set('_serialize', ['pattern']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    
    // delete pattern template and all events for this pattern
    public function deleteWeekTemplate($id=null) {   
       
    }
    
    public function addWeekTemplate()
    {
        $patternsTable = TableRegistry::get('Patterns');
        //add a 7 day template of patterns for employee
        $x = 1;
        $employee = $this->request->query('employee_id');
        //$selecteddate = $this->request->query('selecteddate');
        
        $selectedstartdate = $this->request->query('selectedstartdate');
        $selectedenddate = $this->request->query('selectedenddate');
        $patternparentid = $this->request->query('pattern_parent_id');
        
        // check if date picker date has been selected
        if($selectedstartdate){
            $startDate = \DateTime::createFromFormat('Y-m-d', $selectedstartdate);
            $startDate->format('Y-m-d');          
            $startDate->modify('-1 day');
            
        }else{

            $dateObj = new \DateTime();
            // create a start date that is 1st April of the current year - includes
            // test if we are in Jan/Feb or Mar
            $startMonth = $dateObj->format("m");
            
            if($startMonth == '01' || $startMonth == '02' || $startMonth == '03')
                {
                    $startDate = $dateObj->modify("-1 year");
                    $startDate = $startDate->format("Y-03-31");
                }
            else
                {
                    $startDate = $dateObj->format("Y-03-31");
                }
                
            $startDate = strtotime('first Saturday of next month ' . $startDate); 
            $startDate = new \DateTime("@$startDate"); 
                
        }

        while($x <= 7) {
            
            $pattern = $patternsTable->newEntity();
            $pattern->employee_id = $employee;
            $pattern->day_of_week = $x;           
            $pattern->week_of_year = 1;
            $pattern->starting_on = 1;
            //number of weeks for pattern
            $pattern->repeat_after = 12;
            $pattern->night_shift = 0;
            //default resource id for pattern template
            $pattern->resource_id = 33;
            $pattern->start_date =  $startDate->modify('+1 day');
            //$pattern->start_date =  $startDate;
            $pattern->event_type = 'pattern';
            $pattern->pattern_parent_id = $patternparentid;
               
            $this->Patterns->save($pattern);
            
            $x++;    
            
        }

        $this->Flash->success(__('The Shift template has been saved.'));
        //return $this->redirect(['controller' => 'employees', 'action' => 'view_all']);
        return $this->redirect($this->referer());

    }   
    
    public function add()
    {
        $pattern = $this->Patterns->newEntity();
        
        if ($this->request->is('post')) {
            $pattern = $this->Patterns->patchEntity($pattern, $this->request->data);
            if ($this->Patterns->save($pattern)) {
                $this->Flash->success(__('The pattern has been saved.'));
                return $this->redirect(['controller' => 'employees', 'action' => 'view', $this->request->data['employee_id']]);
                //return $this->redirect( Router::url( $this->referer(), true ) );
            } else {
                $this->Flash->error(__('The pattern could not be saved. Please, try again.'));
            }
        }
        
        //use to set default employee in form dropdown
        $employee = $this->request->query('employee_id');
        
        $employees = $this->Patterns->Employees->find('list', ['limit' => 200]);
        $resources = $this->Patterns->Resources->find('list', ['limit' => 200]);
        
        // $resources = TableRegistry::get('Resources');
        // $resources->recover();
        
        // $query = $resources->find('treeList', [
        //                         'keyPath' => 'id',
        //                         'valuePath' => 'title',
        //                         'spacer' => '-'
        //                     ]);
        
        //$this->paginate['contain'] = ['ParentResources'];
        
        $query = $this->Patterns->Resources->Parent->find('all', [
            'contain' => ['Children'],
        ]);

        $query = $query->toArray();
        
        // re hash $query to show parents and children in select list
        $list = array();

        foreach($query as $parent) {
            foreach($parent->children as $children) {
                $id = $children['id'];
                $name = $parent['title'] . ' - ' . $children['title'];
                $list[$id] = $name;
            }     
        }
        
        $this->set('query', $list);
        
        $this->set(compact('pattern', 'employees', 'resources', 'employee', 'query'));
        $this->set('_serialize', ['pattern']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pattern id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $employee = $this->request->query('employee_id');
        $url = $this->request->query('url');
        $pattern = $this->Patterns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $pattern = $this->Patterns->patchEntity($pattern, $this->request->data);
            
            if ($this->Patterns->save($pattern)) 
            {        
                $this->Flash->success(__('The pattern has been saved.'));
                if ($this->Patterns->Events->deleteAll(['pattern_id' => $id]))
                
                {
                    $this->Flash->success(__('Events have been deleted.'));
                    return $this->redirect($url);
                    
                }else{
                    $this->Flash->error(__('Sorry no can do events.....'));
                    return $this->redirect($url);
                } 

            } else {
                $this->Flash->error(__('The pattern could not be saved. Please, try again.'));
            } 

        }
        
        $employees = $this->Patterns->Employees->find('list', ['limit' => 200]);
        $resources = $this->Patterns->Resources->find('list', ['limit' => 200]);
        
        $query = $this->Patterns->Resources->Parent->find('all', [
            'contain' => ['Children'],
        ]);

        $query = $query->toArray();
        
        // re hash $query to show parents and children in select list
        $list = array();

        foreach($query as $parent) {
            foreach($parent->children as $children) {
                $id = $children['id'];
                $name = $parent['title'] . ' - ' . $children['title'];
                $list[$id] = $name;
            }     
        }
        
        $this->set('query', $list);
     
        $this->set(compact('pattern', 'employees', 'resources'));
        $this->set('_serialize', ['pattern']);

    }

    /**
     * Delete method
     *
     * @param string|null $id Pattern id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pattern = $this->Patterns->get($id);
        if ($this->Patterns->delete($pattern)) {
            $this->Flash->success(__('The pattern has been deleted.'));
        } else {
            $this->Flash->error(__('The pattern could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
