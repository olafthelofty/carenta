<?php
namespace App\Model\Table;

use App\Model\Entity\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Resources
 */
class EventsTable extends Table
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

        $this->table('events');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('CounterCache', [
            'Patterns' => [
                'event_count' => [
                    'conditions' => ['Events.allDay' => false]
                ]
            ]
        ]);

        $this->belongsTo('Resources', [
            'foreignKey' => 'resource_id'
        ]);
        $this->belongsTo('Patterns', [
            'foreignKey' => 'pattern_id',
            'joinType' => 'INNER'
            //'dependent' => true
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
            ->requirePresence('startdate', 'create')
            ->notEmpty('startdate');

        $validator
            ->requirePresence('enddate', 'create')
            ->notEmpty('enddate');

        $validator
            ->requirePresence('allDay', 'create')
            ->notEmpty('allDay');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['resource_id'], 'Resources'));
        return $rules;
    }
}
