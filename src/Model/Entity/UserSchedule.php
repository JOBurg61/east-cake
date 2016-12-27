<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserSchedule Entity
 *
 * @property string $id
 * @property int $volunteer_id
 * @property string $volunteer_name
 * @property int $venue_id
 * @property string $type
 * @property int $job_id
 * @property string $job
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 *
 * @property \App\Model\Entity\Venue $venue
 */
class UserSchedule extends Entity
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
        'user_id' => false
    ];
}
