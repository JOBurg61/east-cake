<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserSchedules Controller
 *
 * @property \App\Model\Table\UserSchedulesTable $UserSchedules
 */
class UserSchedulesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $this->paginate = [
            'contain' => ['Users', 'Venues', 'Jobs']
        ];
		
		# If you aren't an admin, you only get to see your own schedules.
		if(!in_array($this->Auth->user('role'), ['admin','coordinator']))
		{
			$id = $this->Auth->user('id');
		}
		
		$userSchedules = $this->UserSchedules->find()->where(['volunteer_id' => $id])->order(['start_date' => 'ASC']);
		
        $userSchedules = $this->paginate($userSchedules);

        $this->set(compact('userSchedules'));
        $this->set('_serialize', ['userSchedules']);
    }

    /**
     * View method
     *
     * @param string|null $id User Schedule id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userSchedule = $this->UserSchedules->get($id, [
            'contain' => ['Volunteers', 'Venues', 'Jobs']
        ]);

        $this->set('userSchedule', $userSchedule);
        $this->set('_serialize', ['userSchedule']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userSchedule = $this->UserSchedules->newEntity();
        if ($this->request->is('post')) {
            $userSchedule = $this->UserSchedules->patchEntity($userSchedule, $this->request->data);
            if ($this->UserSchedules->save($userSchedule)) {
                $this->Flash->success(__('The user schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user schedule could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->UserSchedules->Volunteers->find('list', ['limit' => 200]);
        $venues = $this->UserSchedules->Venues->find('list', ['limit' => 200]);
        $jobs = $this->UserSchedules->Jobs->find('list', ['limit' => 200]);
        $this->set(compact('userSchedule', 'volunteers', 'venues', 'jobs'));
        $this->set('_serialize', ['userSchedule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Schedule id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userSchedule = $this->UserSchedules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userSchedule = $this->UserSchedules->patchEntity($userSchedule, $this->request->data);
            if ($this->UserSchedules->save($userSchedule)) {
                $this->Flash->success(__('The user schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user schedule could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->UserSchedules->Volunteers->find('list', ['limit' => 200]);
        $venues = $this->UserSchedules->Venues->find('list', ['limit' => 200]);
        $jobs = $this->UserSchedules->Jobs->find('list', ['limit' => 200]);
        $this->set(compact('userSchedule', 'volunteers', 'venues', 'jobs'));
        $this->set('_serialize', ['userSchedule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Schedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userSchedule = $this->UserSchedules->get($id);
        if ($this->UserSchedules->delete($userSchedule)) {
            $this->Flash->success(__('The user schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The user schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
