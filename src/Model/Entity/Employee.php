<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity.
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $finish_date
 * @property string $telephone
 * @property string $mobile
 * @property string $email
 * @property string $address_1
 * @property string $address_2
 * @property string $town
 * @property int $county_id
 * @property \App\Model\Entity\County $county
 * @property string $postcode
 * @property \Cake\I18n\Time $date_of_birth
 * @property string $ni_number
 * @property bool $timesheet_user
 * @property int $exit_reason_id
 * @property \App\Model\Entity\ExitReason $exit_reason
 * @property int $role_id
 * @property \App\Model\Entity\Role $role
 * @property int $nationality_id
 * @property \App\Model\Entity\Nationality $nationality
 * @property int $ethnicity_id
 * @property \App\Model\Entity\Ethnicity $ethnicity
 * @property int $exit_destination_id
 * @property \App\Model\Entity\ExitDestination $exit_destination
 * @property bool $current
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Employee extends Entity
{

    protected $_virtual = ['full_name'];
    
    protected function _getFullName()
    {
        return $this->_properties['first_name'] . '  ' .
            $this->_properties['last_name'];
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
