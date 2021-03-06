<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $role
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $username
 */
class User extends Entity
{

	protected $_virtual = ['full_name', 'scheduled_hours'];
	
	protected function _getScheduledHours(){
		$hours = date_create('00:00');
		$zero = clone($hours);

		foreach($this->schedules as $s) {
				$b = date_create($s->start_date);
				$e = date_create($s->end_date);
				$hours->add(date_diff($b, $e));
		}
		
		return $zero->diff($hours)->format("%H:%I");
	}

    protected function _getFullName() {
        return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
    }
	
	protected function _getUsername(){
			return $this->_properties['email'];	
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

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
	
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }

}
