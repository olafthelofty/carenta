<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Patterns Controller
 *
 * @property \App\Model\Table\PatternsTable $Patterns
 */
class PatternsController extends AppController
{
    // sets up a feed for calendar events, consumed as json
    public function feed() {
        
        $employee_id = $this->request->query('employee_id');
            //$vars = $this->params['url'];
            //$conditions = array('conditions' => array('UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']));
        
            $patterns = $this->Patterns->find('all', [
                'contain' => ['Employees', 'Resources'],
                'conditions' => ['Patterns.employee_id' => $employee_id]
            ]);
        
            foreach($patterns as $pattern) {
                
                //get first name initial
                $employee_initial = substr($pattern['employee']['first_name'], 0, 1);

                // create data array to send to patterns/feed.json
                $data[] = array(
                        'id' => $pattern['id'],
                        'employee_id'=> $pattern['employee_id'],
                        'day_of_week' => $pattern['day_of_week'],
                        'week_of_year' => $pattern['week_of_year'],
                        'starting_on' => $pattern['starting_on'],
                        'night_shift' => $pattern['night_shift'],
                        'resource_id' => $pattern['resource_id'],
                        'title' => $pattern['resource']['title'],
                        'starttime' => $pattern['resource']['start_time'],
                        'endtime' => $pattern['resource']['end_time'],
                        'resourceTitle' => $pattern['resource']['title'],
                        'employee_name' => $employee_initial . ' ' . $pattern['employee']['last_name'],
                        'pattern_id'=> $pattern['id'],
                        'event_type' => $pattern['event_type']

                );
            }
        
            //Do not use a view template.
            //$this->layout="empty";

            $this->set(['patterns' => $data, '_serialize' => 'patterns']);

    } 

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'Resources']
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
    public function deleteWeekTemplate($id=null)
    {
        $employee = $this->request->query('employee_id');
        //$pattern = $this->request->data('id');

        if ($this->Patterns->deleteAll(['employee_id' => $employee])) 
        {
            $this->Flash->success(__('Pattern template has been deleted.'));
        }else{

            $this->Flash->error(__('Sorry no can do.....'));

        }

    if ($this->Patterns->Events->deleteAll(['employee_id' => $employee])) 
        {
            $this->Flash->success(__('Events have been deleted.'));
            return $this->redirect($this->referer());
        }else{

            $this->Flash->error(__('Sorry no can do events.....'));
        }        
            
        $this->autoRender = false;
    }
    
    public function addWeekTemplate()
    {
        //add a 7 day set of patterns for employee

        $x = 1;
        $employee = $this->request->query('employee_id');
        
        //$query = $this->Patterns->find('first', ['employee_id' => $employee]);
        $query = $this->Patterns->findAllByEmployee_id($employee);
        
        if (!$query->isEmpty()) {
             exit("gone");
        }
      
        while($x <= 7) {
            
            $pattern = $this->Patterns->newEntity();
            $pattern->employee_id = $employee;
            $pattern->day_of_week = $x;           
            $pattern->week_of_year = 1;
            $pattern->starting_on = 1;
            $pattern->repeat_after = 1;
            $pattern->night_shift = 0;
            $pattern->resource_id = 1;
            $pattern->event_type = 'pattern';
            
            $this->Patterns->save($pattern);
            
            $x++;
            
        }
        
            if ($this->Patterns->save($pattern)) {
                $this->Flash->success(__('The Shift template has been saved.'));
                //return $this->redirect(['controller' => 'employees', 'action' => 'view', $employee]);
                return $this->redirect($this->referer());
                
            } else {
                $this->Flash->error(__('The Shift template could not be saved. Please, try again.'));
            }
        
        $this->autoRender = false;
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
        $this->set(compact('pattern', 'employees', 'resources', 'employee'));
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
                } 

            } else {
                $this->Flash->error(__('The pattern could not be saved. Please, try again.'));
            } 

        }
        
        $employees = $this->Patterns->Employees->find('list', ['limit' => 200]);
        $resources = $this->Patterns->Resources->find('list', ['limit' => 200]);
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
