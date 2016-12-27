<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;

/**
 * Jobs Controller
 *
 * @property \App\Model\Table\JobsTable $Jobs
 */
class JobsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->viewBuilder()->layout('east');
		#$this->Auth->allow();
	}

	public function confirm()
	{
		$this->viewBuilder()->layout('wg');
		
		 if ($this->request->is('post')) {
            $connection = ConnectionManager::get('default');
            $arrived = $this->request->data('arrived');
			$departed = $this->request->data('departed');
			$uid = $this->request->session()->read('Auth.User.id');
			
			$tasks = $this->request->data('job');
			
			foreach($tasks as $f => $jid ){
				$sql = "insert into applicants(user_id, job_id, arrival, departure) values($uid, $jid, to_timestamp('$arrived', 'MM/DD/YYYY'), to_timestamp('$departed', 'MM/DD/YYYY'))";
				//Log::write('debug', $sql);
				$connection->execute($sql);
			}
						
            return $this->redirect('http://www.wintergrass.com/');
         } else {
			$jobs = $this->paginate($this->Jobs->find()->order(['id' => 'ASC']));
			$this->set(compact('jobs'));
			$this->set('_serialize', ['jobs']);
         }
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $jobs = $this->paginate($this->Jobs->find()->order(['id' => 'ASC']));

        $this->set(compact('jobs'));
        $this->set('_serialize', ['jobs']);
    }

    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => ['Tasks']
        ]);

        $this->set('job', $job);
        $this->set('_serialize', ['job']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $job = $this->Jobs->newEntity();
        if ($this->request->is('post')) {
            $job = $this->Jobs->patchEntity($job, $this->request->data);
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The job could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('job'));
        $this->set('_serialize', ['job']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->data);
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The job could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('job'));
        $this->set('_serialize', ['job']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $job = $this->Jobs->get($id);
        if ($this->Jobs->delete($job)) {
            $this->Flash->success(__('The job has been deleted.'));
        } else {
            $this->Flash->error(__('The job could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
