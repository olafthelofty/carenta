<?php
namespace App\Model\Table;

use App\Model\Entity\PatternParent;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PatternParents Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Employees
 */
class PatternParentsTable extends Table
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

        $this->table('pattern_parents');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id'
        ]);
        
        //===============================
        $this->hasMany('Patterns', [
            'foreignKey' => 'pattern_parent_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
            'exclusive' => false
        ]); 
        //===============================
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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->add('parent_start', 'valid', ['rule' => 'date'])
            ->requirePresence('parent_start', 'create')
            ->notEmpty('parent_start');

        $validator
            ->add('parent_end', 'valid', ['rule' => 'date'])
            ->requirePresence('parent_end', 'create')
            ->notEmpty('parent_end');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        return $rules;
    }
}
