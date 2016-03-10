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
        
            //$vars = $this->params['url'];
            //$conditions = array('conditions' => array('UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']));
            $patterns = $this->Patterns->find('all');//, $conditions);
            foreach($patterns as $pattern) {
                
//                if(!$resource['parentID'] == 0) {
//                    $parentId = $resource['parentID'];
//                }else{
//                    $parentId = null;
//                }     

                $data[] = array(
                        'id' => $pattern['id'],
                        'employee_id'=> $pattern['employee_id'],
                        'day_of_week' => $pattern['day_of_week'],
                        'week_of_year' => $pattern['week_of_year'],
                        'starting_on' => $pattern['starting_on'],
                        'night_shift' => $pattern['night_shift']

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
            'contain' => ['Employees']
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
            'contain' => ['Employees']
        ]);

        $this->set('pattern', $pattern);
        $this->set('_serialize', ['pattern']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pattern = $this->Patterns->newEntity();
        if ($this->request->is('post')) {
            $pattern = $this->Patterns->patchEntity($pattern, $this->request->data);
            if ($this->Patterns->save($pattern)) {
                $this->Flash->success(__('The pattern has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pattern could not be saved. Please, try again.'));
            }
        }
        $employees = $this->Patterns->Employees->find('list', ['limit' => 200]);
        $this->set(compact('pattern', 'employees'));
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
        $pattern = $this->Patterns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pattern = $this->Patterns->patchEntity($pattern, $this->request->data);
            if ($this->Patterns->save($pattern)) {
                $this->Flash->success(__('The pattern has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pattern could not be saved. Please, try again.'));
            }
        }
        $employees = $this->Patterns->Employees->find('list', ['limit' => 200]);
        $this->set(compact('pattern', 'employees'));
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
