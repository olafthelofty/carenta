<?php
namespace App\Model\Table;

use App\Model\Entity\Employee;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Counties
 * @property \Cake\ORM\Association\BelongsTo $ExitReasons
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $Nationalities
 * @property \Cake\ORM\Association\BelongsTo $Ethnicities
 * @property \Cake\ORM\Association\BelongsTo $ExitDestinations
 */
class EmployeesTable extends Table
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

        $this->table('employees');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Counties', [
            'foreignKey' => 'county_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExitReasons', [
            'foreignKey' => 'exit_reason_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Nationalities', [
            'foreignKey' => 'nationality_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Ethnicities', [
            'foreignKey' => 'ethnicity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExitDestinations', [
            'foreignKey' => 'exit_destination_id',
            'joinType' => 'INNER'
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
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->add('start_date', 'valid', ['rule' => 'date'])
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

//        $validator
//            ->add('finish_date', 'valid', ['rule' => 'date'])
//            ->requirePresence('finish_date', 'create')
//            ->notEmpty('finish_date');

        $validator
            ->requirePresence('telephone', 'create')
            ->notEmpty('telephone');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('address_1', 'create')
            ->notEmpty('address_1');

        $validator
            ->requirePresence('address_2', 'create')
            ->notEmpty('address_2');

        $validator
            ->requirePresence('town', 'create')
            ->notEmpty('town');

        $validator
            ->requirePresence('postcode', 'create')
            ->notEmpty('postcode');

        $validator
            ->add('date_of_birth', 'valid', ['rule' => 'date'])
            ->requirePresence('date_of_birth', 'create')
            ->notEmpty('date_of_birth');

        $validator
            ->requirePresence('ni_number', 'create')
            ->notEmpty('ni_number');

        $validator
            ->add('timesheet_user', 'valid', ['rule' => 'boolean'])
            ->requirePresence('timesheet_user', 'create')
            ->notEmpty('timesheet_user');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['county_id'], 'Counties'));
        $rules->add($rules->existsIn(['exit_reason_id'], 'ExitReasons'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['nationality_id'], 'Nationalities'));
        $rules->add($rules->existsIn(['ethnicity_id'], 'Ethnicities'));
        $rules->add($rules->existsIn(['exit_destination_id'], 'ExitDestinations'));
        return $rules;
    }
}
