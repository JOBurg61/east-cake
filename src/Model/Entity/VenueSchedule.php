<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VenueSchedule Entity
 *
 * @property string $id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property string $text
 * @property int $venue_id
 *
 * @property \App\Model\Entity\Venue $venue
 */
class VenueSchedule extends Entity
{

}
