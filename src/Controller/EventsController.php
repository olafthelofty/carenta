<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{
 
//    // sets up a feed for calendar events, consumed as json
//    public function feed() {
//        
//            //$vars = $this->params['url'];
//            //$conditions = array('conditions' => array('UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']));
//            $events = $this->Events->find('all');//, $conditions);
//            foreach($events as $event) {
//                
////                if(!$resource['parentID'] == 0) {
////                    $parentId = $resource['parentID'];
////                }else{
////                    $parentId = null;
////                }     
//
//                $data[] = array(
//                        'id' => $event['id'],
//                        'employee_id'=> $event['employee_id'],
//                        'day_of_week' => $event['day_of_week']
//
//                );
//            }
//
//            $this->set(['events' => $data, '_serialize' => 'events']);
//
//    } 
    
function eventadd($allday=null,$day=null,$month=null,$year=null,$hour=null,$min=null) {
        if (empty($this->data)) {
            //Set default duration: 1hr and format to a leading zero.
            $hourPlus=intval($hour)+1;
            
            
            
            if (strlen($hourPlus)==1) {
                $hourPlus = '0'.$hourPlus;
            }

            //Create a time string to display in view. The time string
            //is either  "Fri 26 / Mar, 09 : 00 â€” 10 : 00" or
            //"All day event: (Fri 26 / Mar)"
            
            if ($allday=='true') {
                $event['Events']['allday'] = 1;
                $displayTime = 'All day event: ('
                    . date('D',strtotime($day.'/'.$month.'/'.$year)).' '.
                    $day.' / '. date("M", mktime(0, 0, 0, $month, 10)).')';
            } else {
                $event['Events']['allday'] = 0;
                $displayTime = date('D',strtotime($day.'/'.$month.'/'.$year)).' '
                    .$day.' / '.date("M", mktime(0, 0, 0, $month, 10)).
                    ', '.$hour.' : '.$min.' &mdash; '.$hourPlus.' : '.$min;
            }
            
            
            
            $this->set("displayTime",$displayTime);

            //Populate the event fields for the add form
            $event['Events']['title'] = 'Event description';
            $event['Events']['start'] = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
            $event['Events']['end'] = $year.'-'.$month.'-'.$day.' '.$hourPlus.':'.$min.':00';
            $this->set('events',$event);

            //Do not use a view template.
            //$this->layout="empty";
            
            
        } else {
            //Create and save the new event in the table.
            //Event type is set to editable - because this is a user event.
            $this->Event->create();
            $this->data['Events']['title'] = Sanitize::paranoid($this->data["Events"]["title"], array('!','\'','?','_','.',' ','-'));
            $this->data['Events']['editable']='1';
            $this->data['Events']['start'] = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
            $this->Event->save($this->data);
            $this->redirect(array('controller' => "events", 'action' => "index"));
        }
    
    //echo json_encode($this->data);
    
    
    }

   
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Resources']
        ];
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Resources']
        ]);

        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $resources = $this->Events->Resources->find('list', ['limit' => 200]);
        $this->set(compact('event', 'resources'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $resources = $this->Events->Resources->find('list', ['limit' => 200]);
        $this->set(compact('event', 'resources'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
