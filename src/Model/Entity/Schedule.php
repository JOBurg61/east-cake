<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property int $id
 * @property int $job_id
 * @property int $user_id
 * @property string $type
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 *
 * @property \App\Model\Entity\Job $job
 * @property \App\Model\Entity\User $user
 */
class Schedule extends Entity
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
        'id' => true,
		'type' =>true,
		'user_id' => true
    ];
}
