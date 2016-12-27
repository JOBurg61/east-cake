<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VenueSchedules Controller
 *
 * @property \App\Model\Table\VenueSchedulesTable $VenueSchedules
 */
class VenueSchedulesController extends AppController
{
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $this->paginate = [
            'contain' => ['Venues']
        ];
		
		if(is_null($id)){
			$venueSchedules = $this->VenueSchedules->find();
		}else{
			$venueSchedules = $this->VenueSchedules->find()->where(['venue_id' => $id]);
		}
		
        $this->set(compact('venueSchedules'));
        $this->set('_serialize', ['venueSchedules']);
    }
	
	public function user($id = null)
    {
        $this->paginate = [
            'contain' => ['Venues']
        ];
		
		if(is_null($id)){
			$venueSchedules = $this->VenueSchedules->find();
		}else{
			$venueSchedules = $this->VenueSchedules->find()->where(['user_id' => $id]);
		}
		
        $this->set(compact('userSchedules'));
        $this->set('_serialize', ['userSchedules']);
    }

    /**
     * View method
     *
     * @param string|null $id Venue Schedule id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $venueSchedule = $this->VenueSchedules->get($id, [
            'contain' => ['Venues']
        ]);

        $this->set('venueSchedule', $venueSchedule);
        $this->set('_serialize', ['venueSchedule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Venue Schedule id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $venueSchedule = $this->VenueSchedules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $venueSchedule = $this->VenueSchedules->patchEntity($venueSchedule, $this->request->data);
            if ($this->VenueSchedules->save($venueSchedule)) {
                $this->Flash->success(__('The venue schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The venue schedule could not be saved. Please, try again.'));
            }
        }
        $venues = $this->VenueSchedules->Venues->find('list', ['limit' => 200]);
        $this->set(compact('venueSchedule', 'venues'));
        $this->set('_serialize', ['venueSchedule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Venue Schedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $venueSchedule = $this->VenueSchedules->get($id);
        if ($this->VenueSchedules->delete($venueSchedule)) {
            $this->Flash->success(__('The venue schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The venue schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
