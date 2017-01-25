<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Error\Debugger;
use Cake\Log\Log;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 */
class SchedulesController extends AppController
{
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Jobs', 'Users']
        ];
        $schedules = $this->paginate($this->Schedules);

        $this->set(compact('schedules'));
        $this->set('_serialize', ['schedules']);
    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => ['Jobs', 'Users']
        ]);
		#$this->log($schedule);
        $this->set('schedule', $schedule);
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schedule = $this->Schedules->newEntity();
		 
		$type = null;
		
		if(in_array($this->Auth->user('role'), ['admin','coordinator'])){
			$type = 'final';
		}else{
			$type = 'pend';
			$this->request->data['user_id'] =  $this->Auth->user('id');
		}
		
		$schedule->set('type', $type);
		
	    if ($this->request->is('post')) {	
			
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
			//Log::debug($schedule);
			
            if ($this->Schedules->save($schedule)) {
                return $this->redirect(['action' => 'index']);
            } else {
				debug($schedule, false, false);
				$this->Flash->error(__('The schedule could not be saved. Please, try again.'));
            }

        }
		
        $jobs = $this->Schedules->Jobs->find('list', ['limit' => 200]);
        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'jobs', 'users'));
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => []
        ]);
		
		if(!in_array($this->Auth->user('role'),['admin','coordinator'])) 
		{
			$this->request->data['user_id'] = $this->Auth->user('id');
			$schedule->set('type', 'pend');
		}else{
			$schedule->set('type', 'final');
		}
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
            }
        }
		
        $jobs = $this->Schedules->Jobs->find('list', ['limit' => 200]);
        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'jobs', 'users'));
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
		$schedule = null;
		
		if(in_array($this->Auth->user('role'),['admin','coordinator'])) 
		{	
			$schedule = $this->Schedules->get($id);
			if ($this->Schedules->delete($schedule)) {
				$this->Flash->success(__('The schedule has been deleted.'));
			}
		}
		
        return $this->redirect(['action' => 'index']);
    }
}
