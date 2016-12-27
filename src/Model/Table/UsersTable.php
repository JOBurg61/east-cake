<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
	
	 
	public function findScheduledHours(Query $query, array $options = [])
    {
        #$hrs = $query->func()->sum('start_date - end_date');
		$query->select(['scheduled_hours' => $this->Schedules->func()->sum('start_date - end_date')])->group('user_id');
        
        return $query;
    }
	
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('full_name');
        $this->primaryKey('id');
		$this->hasMany('Applicants');
		$this->hasMany('Schedules');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->integer('id')->allowEmpty('id', 'create');

        $validator->allowEmpty('first_name');

        $validator->allowEmpty('last_name');

        $validator->allowEmpty('password');

        $validator->allowEmpty('role')
			->add('role', 'inList', [
				'rule' => ['inList', ['admin', 'coordinator', 'volunteer', 'applicant']],
				'message' => 'Please enter a valid role'
            ]);;


        $validator->allowEmpty('username');
			
		$validator->email('email');

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
        return $rules;
    }
}
