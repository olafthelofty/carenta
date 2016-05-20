<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event; 

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
         $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Projects',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
        ]);
        
         
    }    
  
  public $components = [
      // Here we can configure our action maps, finders and all kinds of things
//      'Crud.Crud' => [
//          'actions' => [
//               // 'index' => 'Crud.Index', // Map any index action to the Crud index action handler
//                'edit' => 'Crud.Edit',
//                'add' => 'Crud.Add',
//                'delete' => 'Crud.Delete',
//                'view' => [
//                  // Configure the options for this action method
//                  'className' => 'Crud.View',
//                  'validateId' => false
//              ]//,
//             // 'admin_index' => 'Crud.index', // We can even hookup prefix methods
//             // 'admin_add' => 'Crud.add',
//              //'admin_edit' => 'Crud.edit',
//             // 'admin_delete' => 'Crud.delete'
//          ]
//      ]
  ];
    
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['display']);
        //$this->Crud->listener('relatedModels')->relatedModels(true);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    public function __dayFromNumber($day)
    {
        $dates = array(
            0 => 'sunday',
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday',
        );
        return $dates[$day];
    }
}
