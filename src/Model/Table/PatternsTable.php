<?php
namespace App\Model\Table;

use App\Model\Entity\Pattern;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patterns Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Employees
 * @property \Cake\ORM\Association\BelongsTo $Resources
 */
class PatternsTable extends Table
{
    
    public function findAll(Query $query, array $options)
{
    return $query->order(['Patterns.day_of_week' => 'ASC']);
}

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('patterns');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Resources', [
            'foreignKey' => 'resource_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'pattern_id',
            'dependent' => true
        ]); 
        //=================================
        $this->belongsTo('PatternParents', [
            'foreignKey' => 'pattern_parent_id',
            'joinType' => 'INNER'
        ]); 
        //=================================             
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
            ->add('day_of_week', 'valid', ['rule' => 'numeric'])
            ->requirePresence('day_of_week', 'create')
            ->notEmpty('day_of_week');

        $validator
            ->add('week_of_year', 'valid', ['rule' => 'numeric'])
            ->requirePresence('week_of_year', 'create')
            ->notEmpty('week_of_year');

        $validator
            ->add('starting_on', 'valid', ['rule' => 'numeric'])
            ->requirePresence('starting_on', 'create')
            ->notEmpty('starting_on');

        $validator
            ->add('start_date', 'valid', ['rule' => 'date'])
            ->allowEmpty('start_date');

        $validator
            ->add('repeat_after', 'valid', ['rule' => 'numeric'])
            ->requirePresence('repeat_after', 'create')
            ->notEmpty('repeat_after');

        // $validator
        //     ->add('night_shift', 'valid', ['rule' => 'boolean'])
        //     ->allowEmpty('night_shift');

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
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        $rules->add($rules->existsIn(['resource_id'], 'Resources'));
        return $rules;
    }
}
