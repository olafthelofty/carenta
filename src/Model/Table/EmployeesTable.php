<?php
namespace App\Model\Table;

use App\Model\Entity\Employee;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

// Slack integration, after save
use lygav\slackbot\SlackBot;
use ArrayObject;

/**
 * Employees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Counties
 * @property \Cake\ORM\Association\BelongsTo $ExitReasons
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $Nationalities
 * @property \Cake\ORM\Association\BelongsTo $Ethnicities
 * @property \Cake\ORM\Association\BelongsTo $ExitDestinations
 * @property \Cake\ORM\Association\HasMany $Patterns
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
        $this->displayField('full_name');
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
        $this->hasMany('Patterns', [
            'foreignKey' => 'employee_id'
        ]);
        //============================
        $this->hasMany('PatternParents', [
            'foreignKey' => 'employee_id'
        ]);
        //============================
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

        $validator
            ->add('finish_date', 'valid', ['rule' => 'date'])
            ->requirePresence('finish_date', 'create')
            ->notEmpty('finish_date');

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

        $validator
            ->add('current', 'valid', ['rule' => 'boolean'])
            ->requirePresence('current', 'create')
            ->notEmpty('current');

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

    public function afterSave(Event $event, Employee $entity, ArrayObject $options) {
        if ($entity->created) {

            $name = $entity->first_name . ' ' . $entity->last_name;

        }
    
        //send message to Slack
        //add use statement at head of controller: use lygav\slackbot\SlackBot;
        //vendor code lygav php-slackbot, https://github.com/lygav/php-slackbot
        $bot = new SlackBot("https://hooks.slack.com/services/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");
        //$bot->text("Hi")->send();

        $attachment = $bot->buildAttachment("fallback text"/* mandatory by slack */)
            ->setPretext("New employee added:")
            ->setText($name)
            /*
            Human web-safe colors automatically
            translated into HEX equivalent
            */
            ->setColor("lightblue")
            ->setAuthor("Olaf the Lofty")
            //->addField("Name", $name, TRUE)
           // ->addField("short field 2", "i'm also inline", TRUE)
            ->setThumbUrl("http://carenta.somervillehouse.co.uk/img/employeeNew.png");

        $bot->attach($attachment)->send();

    }
}
