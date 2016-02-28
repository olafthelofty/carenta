<?php
namespace App\Model\Table;

use App\Model\Entity\Nationality;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Nationalities Model
 *
 * @property \Cake\ORM\Association\HasMany $Employees
 */
class NationalitiesTable extends Table
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

        $this->table('nationalities');
        $this->displayField('country');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Employees', [
            'foreignKey' => 'nationality_id'
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
            ->requirePresence('country', 'create')
            ->notEmpty('country');

        $validator
            ->add('code', 'valid', ['rule' => 'numeric'])
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        return $validator;
    }
}
