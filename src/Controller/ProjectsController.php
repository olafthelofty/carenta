<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{
  
    public function view($slug) 
    {
        return $this->Crud->execute();
    }

    public function index()      
    { 
        $this->Crud->action()->findMethod('all');
        return $this->Crud->execute();           
    }        
    
    public function add()
    {
        return $this->Crud->execute();
    }

    public function edit($id = null)
    {

        return $this->Crud->execute();
    }

    public function delete($id = null)
    {
        return $this->Crud->execute();
    }
}
