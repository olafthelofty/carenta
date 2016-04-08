<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{
    public function patternevent($id = null) {
        $patterns = TableRegistry::get('Patterns');

        $dowMap = array('SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA');

        // pattern array
        $query = $patterns->find('all', [
            'contain' => ['Resources', 'Employees']
        ]);
        
        foreach ($query as $row) {
            $eventsTable = TableRegistry::get('Events');
            $event = $eventsTable->newEntity();
            
            $freq = 'WEEKLY';
            $count = 12;
            $interval = $row['repeat_after'];
            $wkst = $row['day_of_week'];
            //print_r($wkst);
            $byweekday = $dowMap[$row['day_of_week'] - 1];         
            
            // create date schedule array
            $timezone    = 'UTC';
            $startDate   = new \DateTime('2016-04-07', new \DateTimeZone($timezone));
            //$endDate     = new \DateTime('2013-06-14 20:00:00', new \DateTimeZone($timezone)); // Optional
            $rule = new \Recurr\Rule(
                'FREQ=' . $freq . ';' . 
                'COUNT=' . $count . ';' . 
                'INTERVAL=' . $interval . ';' . 
                //'WKST=' . $wkst . ';' . 
                'BYDAY=' . $byweekday// . ',' . $startDate 
                 );
            
            $transformer = new \Recurr\Transformer\ArrayTransformer();

           // echo '<pre>';
            $array = $transformer->transform($rule);
            
            foreach ($array as $line) {
            
                if(!empty($query)){
                    //loop through patterns to
                    //create all events based on current employee id and current pattern(s)
                    //save to db
                    
                    //format start and end dates including adding start / end hours and minutes
                    $starthours = date('H', strtotime($row->resource->start_time));
                    $startmins = date('i', strtotime($row->resource->start_time));
                    $start = new Time($line->getStart()->format('Y-m-d 00:00:00'));
                    $start->modify('+' . $starthours . ' hours');
                    $start->modify('+' . $startmins . ' minutes');

                    $endhours = date('H', strtotime($row->resource->end_time));
                    $endmins = date('i', strtotime($row->resource->end_time));
                    $end = new Time($line->getStart()->format('Y-m-d 00:00:00'));
                    $end->modify('+' . $endhours . ' hours');
                    $end->modify('+' . $endmins . ' minutes');                                      

                    // event model to save
                    $event->title = $row->employee->first_name[0] . ' ' . $row->employee->last_name . ' - ' . $row->resource->title;
                    $event->startdate = $start;
                    $event->enddate = $end;
                    $event->allDay = ($row->resource_id == 9) ? 'true' : 'false';
                    $event->pattern_id = $row->id;
                    $event->resource_id = $row->resource_id; 
                    $event->employee_id = $row->employee->id;
                    $event->event_type = 'pattern';
                    
                    $eventsTable->save($event);
                }
           }
        }

//echo '<pre>';

}

//    // sets up a feed for calendar events, consumed as json
    public function viewalleventsfeed() {

        $employee_id = $this->request->query('employee_id');
        $events = $this->Events->find('all');//, $conditions);
        
        foreach($events as $event) {
            $allday = ($event['allDay'] == "true") ? true : false;   

            $data[] = array(
                'id' => $event['id'],
                'title' => $event['title'],
                'start' => $event['startdate'],
                'end' => $event['enddate'],
                'resourceId' => $event['resource_id'],
                'resourcesTitle' => $event['Resources']['title'],
                'allDay' => $allday
            );
        }

        $this->set(['events' => $data, '_serialize' => 'events']);
    } 
    
public function ajaxAdd()
{
    $this->autoRender=false;
//      if($this->RequestHandler->isAjax()){
//         Configure::write('debug', 0);
//      }
        if(!empty($this->request->data())){
            $inputData = array();
            $inputData['Events']['title'] = $this->request->data('title');
            $inputData['Events']['startdate'] = $this->request->data('startdate');
            $inputData['Events']['enddate'] = $this->request->data('enddate');
            $inputData['Events']['allDay'] = $this->request->data('allDay');
            $inputData['Events']['pattern_id'] = $this->request->data('pattern_id');
            $inputData['Events']['resource_id'] = $this->request->data('resource_id');
            
            //$data = $this->Event->findByTitle($inputData['Event']['title']);
            $this->Events->create();
           if(empty($data))
           {                   
              if($this->Events->save($inputData))
                  return "success"; 
            }else
            {
             return "error";
           }
        }
    }
    
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
