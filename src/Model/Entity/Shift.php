<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shift Entity.
 *
 * @property int $id
 * @property string $name
 * @property int $day_part_id
 * @property \App\Model\Entity\DayPart $day_part
 * @property int $hours
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Shift extends Entity
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
