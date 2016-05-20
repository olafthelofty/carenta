<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\ORM\Query;
use Cake\Routing\Router;

/**
 * Resources Controller
 *
 * @property \App\Model\Table\ResourcesTable $Resources
 */

// generate pastel color based on title string
function get_color($name) {
    $hash = md5($name);

    $color1 = hexdec(substr($hash, 8, 2));
    $color2 = hexdec(substr($hash, 4, 2));
    $color3 = hexdec(substr($hash, 0, 2));
    if($color1 < 128) $color1 += 128;
    if($color2 < 128) $color2 += 128;
    if($color3 < 128) $color3 += 128;
    
    return "#" . dechex($color1) . dechex($color2) . dechex($color3);
}

class ResourcesController extends AppController
{    
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Resources.heading' => 'desc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    
    // sets up a feed for calendar resources, consumed as json
    public function feed($id=null) {
            //$vars = $this->params['url'];
            //$conditions = array('conditions' => array('UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']));
            $resources = $this->Resources->find('all');//, $conditions);
            foreach($resources as $resource) {
                
                if(!$resource['parent_id'] == 0) {
                    $parentId = $resource['parent_id'];
                }else{
                    $parentId = null;
                }     

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
        $resources = TableRegistry::get('Resources');
           
        // get self referencing model for resources     
        $resources = $this->Resources->find('all', [
            'contain' => ['Children'],
            'conditions' => ['heading' => 1]
        ]);
        
        $this->paginate = ['limit' => 4];

        $this->set('resources', $this->paginate($resources));
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
        $resource = $this->Resources->Children->get($id, [
            'contain' => ['Events', 'Patterns', 'Parent']
        ]);

        $this->set('resource', $resource);
        $this->set('_serialize', ['resource']);
        
        $this->paginate = [
            'Events' => [
                'conditions' => ['Events.resource_id' => $id],
                'limit' => 3
            ],
        ];
        $events = $this->paginate('Events');
        $this->set(compact('events'));      
         
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resources = TableRegistry::get('Resources');
         
        $query = $this->Resources->Parent->find('list', [
            'contain' => ['Children'],
            'conditions' => ['heading' => 1]
        ]);
        
        $resource = $this->Resources->newEntity();
        
        // create random string for color generator
        $random = substr(str_shuffle(MD5(microtime())), 0, 8);
        // create random color using $random seed
        $resource->event_background_color = get_color($random);
        
        if ($this->request->is('post')) {
            $resource = $this->Resources->patchEntity($resource, $this->request->data);
            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The resource could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('resource', 'query'));
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
        
        $url = $this->request->query('url');
        
        $resources = TableRegistry::get('Resources');
        
        $query = $this->Resources->find('list', [
            'contain' => ['Children'],
            'conditions' => ['heading' => 1]
            ]);     
        
        $resource = $this->Resources->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {      
            
            $resource = $this->Resources->patchEntity($resource, $this->request->data);
            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));
                //return $this->redirect(['action' => 'index']);
                //return $this->redirect($this->referer());
                return $this->redirect($url);
                //return $this->redirect($this->request->session()->read($some_var));
                //$this->redirect( Router::url( $this->referer(), true ) );
            } else {
                $this->Flash->error(__('The resource could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('resource', 'query'));
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
