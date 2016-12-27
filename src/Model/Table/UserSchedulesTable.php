<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserSchedules Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Volunteers
 * @property \Cake\ORM\Association\BelongsTo $Venues
 * @property \Cake\ORM\Association\BelongsTo $Jobs
 *
 * @method \App\Model\Entity\UserSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserSchedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserSchedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserSchedule findOrCreate($search, callable $callback = null)
 */
class UserSchedulesTable extends Table
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

        $this->table('venue_schedules');
		
        $this->displayField('volunteer_name');
        $this->primaryKey('volunteer_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'volunteer_id'
        ]);
        $this->belongsTo('Venues', [
            'foreignKey' => 'venue_id',
			'propertyName' => 'venue_data'
        ]);
        $this->belongsTo('Jobs', [
            'foreignKey' => 'job_id',
			'propertyName' => 'job_data'
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
            ->allowEmpty('id');

        $validator
            ->allowEmpty('volunteer_name');

        $validator
            ->allowEmpty('venue');

        $validator
            ->allowEmpty('type');

        $validator
            ->allowEmpty('job');

        $validator
            ->dateTime('start_date')
            ->allowEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->allowEmpty('end_date');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['venue_id'], 'Venues'));
        $rules->add($rules->existsIn(['job_id'], 'Jobs'));

        return $rules;
    }
}
