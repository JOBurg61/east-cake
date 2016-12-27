<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VenueSchedules Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Venues
 *
 * @method \App\Model\Entity\VenueSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\VenueSchedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VenueSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VenueSchedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VenueSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VenueSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VenueSchedule findOrCreate($search, callable $callback = null)
 */
class VenueSchedulesTable extends Table
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
		$this->primaryKey('venue_id');
        $this->belongsTo('Venues', [
            'foreignKey' => 'venue_id'
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
            ->dateTime('start_date')
            ->allowEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->allowEmpty('end_date');

        $validator
            ->allowEmpty('text');

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
        $rules->add($rules->existsIn(['venue_id'], 'Venues'));

        return $rules;
    }
}
