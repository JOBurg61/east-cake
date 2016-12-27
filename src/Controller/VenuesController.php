<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Venues Controller
 *
 * @property \App\Model\Table\VenuesTable $Venues
 */
class VenuesController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		#$this->Auth->allow(['index', 'add', 'schedule', 'calendar']);
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('east');
        $venues = $this->paginate($this->Venues);

        $this->set(compact('venues'));
        $this->set('_serialize', ['venues']);
    }

    public function schedule($id = null)
	{
		$this->viewBuilder()->layout('east');
		        $venue = $this->Venues->get($id, [
            'contain' => []
        ]);
		
		$this->set('venue', $venue);
	}
	
	public function calendar($id = null)
	{
		$this->viewBuilder()->layout('east');
		        $venue = $this->Venues->get($id, [
            'contain' => []
        ]);
		
		$this->set('venue', $venue);
	}
	
	/**
     * View method
     *
     * @param string|null $id Venue id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $venue = $this->Venues->get($id, [
            'contain' => []
        ]);

        $this->set('venue', $venue);
        $this->set('_serialize', ['venue']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $venue = $this->Venues->newEntity();
        if ($this->request->is('post')) {
            $venue = $this->Venues->patchEntity($venue, $this->request->data);
            if ($this->Venues->save($venue)) {
                $this->Flash->success(__('The venue has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The venue could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('venue'));
        $this->set('_serialize', ['venue']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Venue id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $venue = $this->Venues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $venue = $this->Venues->patchEntity($venue, $this->request->data);
            if ($this->Venues->save($venue)) {
                $this->Flash->success(__('The venue has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The venue could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('venue'));
        $this->set('_serialize', ['venue']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Venue id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $venue = $this->Venues->get($id);
        if ($this->Venues->delete($venue)) {
            $this->Flash->success(__('The venue has been deleted.'));
        } else {
            $this->Flash->error(__('The venue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
