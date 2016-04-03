<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Resources Controller
 *
 * @property \App\Model\Table\ResourcesTable $Resources
 */
class ResourcesController extends AppController
{
    
    // sets up a feed for calendar resources, consumed as json
    public function feed($id=null) {
            //$vars = $this->params['url'];
            //$conditions = array('conditions' => array('UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']));
            $resources = $this->Resources->find('all');//, $conditions);
            foreach($resources as $resource) {
                
                if(!$resource['parentID'] == 0) {
                    $parentId = $resource['parentID'];
                }else{
                    $parentId = null;
                }
                
                // format resource headings
                //$durationHrs = ($resource['duration'] / 60 / 60);
//                $durationHrs = ($resource['end_time'] - $resource['start_time']) ;
//                
//                if($resource['duration'] != 0) {
//                    if($resource['duration'] == 3600) {
//                        $title = $resource['title'] . ' ('. $durationHrs . ' hr)';
//                    }
//                    if($resource['duration'] != 3600) {
//                        $title = $resource['title'] . ' ('. $durationHrs . ' hrs)';
//                    }
//                }else{
//                    $title = $resource['title'];    
//                }      

                $data[] = array(
                        'id' => $resource['id'],
                        'title'=> $resource['title'],
                        'eventBackgroundColor' => $resource['event_background_color'],
                        'parentId' => $parentId

                );
            }

            $this->set(['resources' => $data, '_serialize' => 'resources']);

    }       

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $resources = $this->paginate($this->Resources);

        $this->set(compact('resources'));
        $this->set('_serialize', ['resources']);
    }

    /**
     * View method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resource = $this->Resources->get($id, [
            'contain' => ['Events']
        ]);

        $this->set('resource', $resource);
        $this->set('_serialize', ['resource']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resource = $this->Resources->newEntity();
        if ($this->request->is('post')) {
            $resource = $this->Resources->patchEntity($resource, $this->request->data);
            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The resource could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('resource'));
        $this->set('_serialize', ['resource']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resource = $this->Resources->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resource = $this->Resources->patchEntity($resource, $this->request->data);
            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The resource could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('resource'));
        $this->set('_serialize', ['resource']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resource = $this->Resources->get($id);
        if ($this->Resources->delete($resource)) {
            $this->Flash->success(__('The resource has been deleted.'));
        } else {
            $this->Flash->error(__('The resource could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
