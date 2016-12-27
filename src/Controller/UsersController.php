<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Log\Log;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['volunteer', 'login']);
	}
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($q = null)
    {

		if(!in_array($this->Auth->user('role'),['admin','coordinator']))
		{
			return $this->redirect(['action' => 'calendar']);
		}
		
		if(is_null($q)){
			$users = $this->Users->find('all');
		}else{		
			$like = '%' . $q . '%';
			$users = $this->Users->find('all')
								->where(['first_name LIKE' => $like])
								->orWhere(['last_name LIKE' => $like]);
		}
		
		#$users->select(['scheduled_hours' => $this->$schedules->func()->sum('start_date - end_date')])->group('user_id');
		# ['scheduled_hours' => $this->func()->sum('Schedules.start_date - Schedules.end_date')->where(['Users.id' => 'Schedules.user_id'])->group('Schedules.user_id')]	 
		$this->viewBuilder()->layout('east');
		$users = $this->paginate($users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
	
	public function applicants(){ $this->index(); }
	
	public function login()
    {
		$this->viewBuilder()->layout('wg');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
	
	public function calendar($id = null)
	{
		$this->viewBuilder()->layout('east');
		
		#This person is not an admin and has asked for a user's schedule.  Use their own ID to find their own schedule.
		if(!in_array($this->Auth->user('role'),['admin','coordinator'])) 
		{
			$id = $this->Auth->user('id');
		}
		
		$user = $this->Users->get($id, [
            'contain' => []
        ]);
		
		$this->set('user', $user);
	}

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		//$this->viewBuilder()->layout('wg');
       		$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			$user->set('username', $user->email);
            
			if ($this->Users->save($user)) {	
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
	
	public function volunteer()
	{
		//$this->autoRender = false;
		$this->viewBuilder()->layout('wg');
		$user = $this->Users->newEntity();
		
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			$user->set('username', $user->email);
			$user->set('role', 'applicant');
            if ($this->Users->save($user)) {
				$this->Auth->setUser($user->toArray());
  				
				$email = new Email();
				$email->viewVars(['user' => $user]);

				$email->to($user->email)
					->template('default')
					->emailFormat('text')
					->from('wintergrasshelpers@gmail.com')
					->subject('Thanks for Volunteering!')
					->send();
				  
                return $this->redirect(['controller' => 'Jobs', 'action' => 'confirm']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        
		$this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}
	


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
