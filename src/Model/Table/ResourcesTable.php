<?php
namespace App\Model\Table;

use App\Model\Entity\Resource;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Resources Model
 *
 * @property \Cake\ORM\Association\HasMany $Events
 * @property \Cake\ORM\Association\HasMany $Patterns
 */
class ResourcesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('resources');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('Events', [
            'foreignKey' => 'resource_id'
        ]);
        $this->hasMany('Patterns', [
            'foreignKey' => 'resource_id'
        ]);
        
        $this->hasMany('Children', [
                'className' => 'Resources',
                'foreignKey' => 'parent_id'
        ]);
          
        $this->belongsTo('Parent', [
                'className' => 'Resources',
                'foreignKey' => 'parent_id'
        ]);              
        
    }   

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->add('parent_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('parent_id');

        // $validator
        //     ->add('duration', 'valid', ['rule' => 'numeric'])
        //     ->requirePresence('duration', 'create')
        //     ->notEmpty('duration');

        $validator
            ->add('start_time', 'valid', ['rule' => 'time'])
            ->requirePresence('start_time', 'create')
            ->notEmpty('start_time');

        $validator
            ->add('end_time', 'valid', ['rule' => 'time'])
            ->requirePresence('end_time', 'create')
            ->notEmpty('end_time');

        return $validator;
    }
}
