<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pattern Entity.
 *
 * @property int $id
 * @property int $employee_id
 * @property \App\Model\Entity\Employee $employee
 * @property int $day_of_week
 * @property int $week_of_year
 * @property int $starting_on
 * @property \Cake\I18n\Time $start_date
 * @property int $repeat_after
 * @property bool $night_shift
 * @property int $resource_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Pattern extends Entity
{

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
