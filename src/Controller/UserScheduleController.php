<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserSchedule Controller
 *
 * @property \App\Model\Table\UserScheduleTable $UserSchedule
 */
class UserScheduleController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $userSchedule = $this->paginate($this->UserSchedule);

        $this->set(compact('userSchedule'));
        $this->set('_serialize', ['userSchedule']);
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
        $userSchedule = $this->UserSchedule->get($id, [
            'contain' => []
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
        $userSchedule = $this->UserSchedule->newEntity();
        if ($this->request->is('post')) {
            $userSchedule = $this->UserSchedule->patchEntity($userSchedule, $this->request->data);
            if ($this->UserSchedule->save($userSchedule)) {
                $this->Flash->success(__('The user schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user schedule could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('userSchedule'));
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
        $userSchedule = $this->UserSchedule->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userSchedule = $this->UserSchedule->patchEntity($userSchedule, $this->request->data);
            if ($this->UserSchedule->save($userSchedule)) {
                $this->Flash->success(__('The user schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user schedule could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('userSchedule'));
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
        $userSchedule = $this->UserSchedule->get($id);
        if ($this->UserSchedule->delete($userSchedule)) {
            $this->Flash->success(__('The user schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The user schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
