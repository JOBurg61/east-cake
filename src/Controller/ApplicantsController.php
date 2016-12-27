<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Applicants Controller
 *
 * @property \App\Model\Table\ApplicantsTable $Applicants
 */
class ApplicantsController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow();
	}
	
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
        $applicants = $this->paginate($this->Applicants);

        $this->set(compact('applicants'));
        $this->set('_serialize', ['applicants']);
    }

    /**
     * View method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicant = $this->Applicants->get($id, [
            'contain' => ['Jobs', 'Users']
        ]);

        $this->set('applicant', $applicant);
        $this->set('_serialize', ['applicant']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicant = $this->Applicants->newEntity();
        if ($this->request->is('post')) {
            $applicant = $this->Applicants->patchEntity($applicant, $this->request->data);
            if ($this->Applicants->save($applicant)) {
                $this->Flash->success(__('The applicant has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
            }
        }
        $jobs = $this->Applicants->Jobs->find('list', ['limit' => 200]);
        $users = $this->Applicants->Users->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'jobs', 'users'));
        $this->set('_serialize', ['applicant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicant = $this->Applicants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicant = $this->Applicants->patchEntity($applicant, $this->request->data);
            if ($this->Applicants->save($applicant)) {
                $this->Flash->success(__('The applicant has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
            }
        }
        $jobs = $this->Applicants->Jobs->find('list', ['limit' => 200]);
        $users = $this->Applicants->Users->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'jobs', 'users'));
        $this->set('_serialize', ['applicant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicant = $this->Applicants->get($id);
        if ($this->Applicants->delete($applicant)) {
            $this->Flash->success(__('The applicant has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
