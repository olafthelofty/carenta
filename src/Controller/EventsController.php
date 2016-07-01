<?php
namespace App\Controller;
//namespace Carbon;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
 
// http://stackoverflow.com/questions/4293174/grab-all-wednesdays-in-a-given-month-in-php?lq=1
// http://stackoverflow.com/questions/10860745/php-working-with-dates-like-every-other-week-on-tuesday
// create DatePeriod array
function getPatternDays($start, $dow, $step, $starting_on)
{
    // default pattern length
    $repeat_after = 12;
    $start = new \DateTime($start);
    $start->add(new \DateInterval("P{$starting_on}W")); // Offset by starting_on - 1
    $start->modify($dow); // Move to first occurence
    $end = clone $start;
    $end->add(new \DateInterval("P{$repeat_after}W")); // Move to n weeks from start
    $unit = 'W';
    $interval = new \DateInterval("P{$step}{$unit}");
      
    return new \DatePeriod(
            $start,
            $interval,
            $end
    );
}
 
class EventsController extends AppController
{

    // public function initialize()
    // {
    //     parent::initialize();
    //     $this->loadComponent('RequestHandler');
    // }

//  public function annualleave($id = null) {
        
//         $patternParentsTable = TableRegistry::get('PatternParents');
//         //$patterns = TableRegistry::get('Patterns');
//         //$events = TableRegistry::get('Events');
//         $employee_id = $this->request->query('employee_id');
        
//         // // annual leave entitlement calcs
//         // $sum_of_leave_entitlement = 0;
//         // $leave = 0;
//         // $totalleave = 0;
//         // $entitlement = 0;
//         // // default pattern length
//         // $repeat_after = 12;

//         // $dowMap = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');       
        
//         //Find all events in pattern except 'no shift' days 

//          //$eventsCount = $this->PatternParents->Patterns->Events->find('count');

//          $query = $patternParentsTable->find()->contain([ 
//             'Patterns.Events'
//             ]);
//         $number = $query->count();

//         print_r($number);

//         debug($query->toArray());

//         // $query = $patterns->find('all', [
//         //     'conditions' => ['employee_id' => $employee_id],
//         //     'contain' => [
//         //         'Resources' => function ($q) {
//         //             return $q
//         //                 ->where(['Resources.title !=' => 'No Shift']);
//         //         }, 
//         //         'Employees']
//         //     ]);

//         // foreach ($query as $fred) {
//         //    foreach ($fred as $row) { 
//         //     $eventsTable = TableRegistry::get('Events');
            
//         //     // day of week
//         //     $byweekday = $dowMap[$row['day_of_week'] - 1];  
//         //     // start date        
//         //     $patternend = new \DateTime($row['start_date']);
//         //     // every n weeks
//         //     $step = $row->week_of_year;
//         //     // start date offset
//         //     $starting_on = $row->starting_on - 1;
            
//         //     $count_of_leave_entitlement = 0;
//         //     $leave_factor = 5.6;
//         //     $leave = 0;

//         //     foreach (getPatternDays($row['start_date'], $byweekday, $step, $starting_on) as $patternDay) {
  
//         //         $count_of_leave_entitlement++;
                     
//         //     }
            
//         //     $leave = ($count_of_leave_entitlement + $leave);
//         //     $totalleave = $leave + $totalleave;
            
//         // }
//         // }
        
//         // $entitlement = round((($totalleave * 5.6 ) / $repeat_after));
       
//         // //$entitlement = ($entitlement == 0) ? 'Annual Leave not set' :$entitlement . ' days Annual Leave';
        
//         // $this->set(['data' => $entitlement, '_serialize' => 'data']);
        

//         // $this->response->body($entitlement);    
 
//         // $this->autoRender = true;

// }

    public function annualleave($id = null) {
        
        $patternParentsTable = TableRegistry::get('PatternParents');
        $patterns = TableRegistry::get('Patterns');
        $events = TableRegistry::get('Events');
        $employee_id = $this->request->query('employee_id');
        
        // annual leave entitlement calcs
        $sum_of_leave_entitlement = 0;
        $leave = 0;
        $totalleave = 0;
        $entitlement = 0;
        // default pattern length
        $repeat_after = 12;

        $dowMap = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');       
        
        //Find all events in pattern except 'no shift' days 
        $query = $patternParentsTable->find('all', [
            'conditions' => ['employee_id' => $employee_id],
            'contain' => [
                'Patterns',
                'Patterns.Resources' => function ($q) {
                    return $q
                        ->where(['Resources.title !=' => 'No Shift']);
                }, 
                'Patterns.Employees']
            ]);

            //debug($query->toArray());
        // $query = $patterns->find('all', [
        //     'conditions' => ['employee_id' => $employee_id],
        //     'contain' => [
        //         'Resources' => function ($q) {
        //             return $q
        //                 ->where(['Resources.title !=' => 'No Shift']);
        //         }, 
        //         'Employees']
        //     ]);

        foreach ($query as $fred) {
           foreach ($fred as $row) { 
            $eventsTable = TableRegistry::get('Events');
            
            // day of week
            $byweekday = $dowMap[$row['day_of_week'] - 1];  
            // start date        
            $patternend = new \DateTime($row['start_date']);
            // every n weeks
            $step = $row->week_of_year;
            // start date offset
            $starting_on = $row->starting_on - 1;
            
            $count_of_leave_entitlement = 0;
            $leave_factor = 5.6;
            $leave = 0;

            foreach (getPatternDays($row['start_date'], $byweekday, $step, $starting_on) as $patternDay) {
  
                $count_of_leave_entitlement++;
                     
            }
            
            $leave = ($count_of_leave_entitlement + $leave);
            $totalleave = $leave + $totalleave;

        }
        }
        
        $entitlement = round((($totalleave * 5.6 ) / $repeat_after));
       
        //$entitlement = ($entitlement == 0) ? 'Annual Leave not set' :$entitlement . ' days Annual Leave';
        
        $this->set(['data' => $entitlement, '_serialize' => 'data']);
        

        $this->response->body($entitlement);    
 
        $this->autoRender = true;

}

    public function patternevent($id = null) {
        
        $patterns = TableRegistry::get('Patterns');
        $events = TableRegistry::get('Events');
        $employee_id = $this->request->query('employee_id');
        $patternparent_id = $this->request->query('patternparentid');

        $pattern_sun = $this->request->query('patternSun');
        $pattern_mon = $this->request->query('patternMon');
        $pattern_tue = $this->request->query('patternTue');
        $pattern_wed = $this->request->query('patternWed');
        $pattern_thu = $this->request->query('patternThu');
        $pattern_fri = $this->request->query('patternFri');
        $pattern_sat = $this->request->query('patternSat');

        $pattern_id = $this->request->query('id');


        $dowMap = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');

        // delete exisitng events for current patternParent
        // prior to creating events
        $events_to_delete = [

                $pattern_sun,
                $pattern_mon,
                $pattern_tue,
                $pattern_wed, 
                $pattern_thu,
                $pattern_fri,
                $pattern_sat  
        ]; 

        foreach ($events_to_delete as $key => $value)  {
            $events->deleteAll(
                ['pattern_id' => $value]
            );
        }    
        
        $query = $patterns->find('all', [
            //'conditions' => ['employee_id' => $employee_id],
            'conditions' => ['pattern_parent_id' => $patternparent_id],
            //'conditions' => ['Patterns.id' => 2787],
            'contain' => ['Resources', 'Employees']
            ]);

        foreach ($query as $row) {

            //debug($row->toArray());

            $eventsTable = TableRegistry::get('Events');
            
            // day of week
            $byweekday = $dowMap[$row['day_of_week'] - 1];  
            // start date        
            $patternend = new \DateTime($row['start_date']);
            // every n weeks
            $step = $row->week_of_year;
            // start date offset
            $starting_on = $row->starting_on - 1;
            
            foreach (getPatternDays($row['start_date'], $byweekday, $step, $starting_on) as $patternDay) {
           
            // create date schedule array
            $timezone    = 'UTC';
                
                $event = $eventsTable->newEntity();
            
                if(!empty($query)){
                    //loop through patterns to
                    //create all events based on current employee id and current pattern(s)
                    //save to db                  
                    
                    //$count_of_leave_entitlement++;
                                     
                    //format start and end dates including adding start / end hours and minutes
                    $starthours = date('H', strtotime($row->resource->start_time));
                    $startmins = date('i', strtotime($row->resource->start_time));
                    $start = new Time($patternDay->format("Y-m-d"));
       
                    $start->modify('+' . $starthours . ' hours');
                    $start->modify('+' . $startmins . ' minutes');

                    $endhours = date('H', strtotime($row->resource->end_time));
                    $endmins = date('i', strtotime($row->resource->end_time));
                    $end = new Time($patternDay->format("Y-m-d"));
                    
                    if ($row->resource->night_shift == 1){
                    $end->modify('+ 1 day');
                    }
                    
                    $end->modify('+' . $endhours . ' hours');
                    $end->modify('+' . $endmins . ' minutes');                                      

                    // event model to save
                    $event->title = $row->employee->first_name[0] . ' ' . $row->employee->last_name;
                    $event->startdate = $start->format('Y-m-d H:i:s');
                    $event->enddate = $end->format('Y-m-d H:i:s');
                    $event->allDay = $row->resource->allDay;                   
                    $event->pattern_id = $row->id;
                    $event->resource_id = $row->resource_id; 
                    $event->employee_id = $row->employee->id;
                    $event->event_type = 'pattern';
                    
                    $eventsTable->save($event);
                }else {
                    $this->Flash->error(__('The events could not be saved. Please, try again.'));
                }                      
            }            
        }

        
        $this->Flash->success(__('The events have been saved.'));
        return $this->redirect($this->referer());
        $this->autoRender = false;

}

//    // sets up a feed for calendar events, consumed as json, filtered by employee ID
    public function viewfilteredeventsfeed() {
        $events = TableRegistry::get('Events');
        
        //Do not use a view template.
        //$this->layout="empty";
        //$this->autoRender = false;
      
        $employee_id = $this->request->query('employee_id');
        
        if($employee_id == 'showAll'){
            $query = $events->find('all', [
                'contain' => ['Resources.Parent']
                ]);     
        }else{
            $query = $events->find('all', [
                'conditions' => ['employee_id' => $employee_id],
                'contain' => ['Resources.Parent']
            ]);     
        }

        foreach($query as $event) {
            $allday = ($event['allDay'] == "true") ? true : false; 
             
            $data[] = array(
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->startdate,
                'end' => $event->enddate,
                'resourceId' => $event->resource_id,
                'resourcesTitle' => $event->resource->title,
                'resourcesParent' => $event->resource->parent->title,
                'allDay' => $allday
            );
        }

        $this->set(['events' => $data, '_serialize' => 'events']);

    } 

//    // sets up a feed for calendar events, consumed as json, filtered by employee ID
    // public function viewalleventsfeed() {
    //     $events = TableRegistry::get('Events');
        
    //     //Do not use a view template.
    //     //$this->layout="empty";
    //     //$this->autoRender = false;

    //     $employee_id = $this->request->query('employee_id');
            
    //     $query = $events->find('all', [
    //         'conditions' => [],
    //         'contain' => ['Resources']
    //         ]);            
   
    //     foreach($query as $event) {
    //         $allday = ($event['allDay'] == "true") ? true : false; 
             
    //         $data[] = array(
    //             'id' => $event->id,
    //             'title' => $event->title,
    //             'start' => $event->startdate,
    //             'end' => $event->enddate,
    //             'resourceId' => $event->resource_id,
    //             'resourcesTitle' => $event->resource->title,
    //             'allDay' => $allday
    //         );
    //     }

    //     $this->set(['events' => $data, '_serialize' => 'events']);

    // } 
    
 public function deleteWeekTemplate($id=null)
    {
        
        $employee_id = $this->request->query('employee_id');
        
        $events = TableRegistry::get('Events');
        $patterns = TableRegistry::get('Patterns');
        
        if ($patterns->deleteAll(['employee_id' => $employee_id], false))
            {
                $this->Flash->success(__('Pattern template has been deleted.'));      
                if ($events->deleteAll(['employee_id' => $employee_id, 'event_type' => 'pattern'], false))        
                    {
                        $this->Flash->success(__('Events deleted.'));   
                        return $this->redirect($this->referer());
                    }
                else
                    {
                        $this->Flash->error(__('Sorry no can do events.....'));
                        return $this->redirect($this->referer());
                    }
            }
        else
            {                        
                $this->Flash->error(__('Sorry no can do pattern.....'));
                return $this->redirect($this->referer());
            }

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
        //rss check
        if ($this->RequestHandler->isRss() ) {
            $events = $this->Events
                ->find()
                ->limit(20)
                ->order(['created' => 'desc']);
            $this->set(compact('events'));
        } else {


        $this->paginate = [
            'contain' => ['Resources']
        ];
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);

        }
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
