<?php
declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Controller\Api\AppController;
use Cake\Http\Exception\NotFoundException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function index()
    {
        try {
            $users = $this->paginate($this->Users);
        } catch (NotFoundException $e) {
            $users = [];
        }

        $this->set('users', $users);
        
        $this->viewBuilder()->setOption('serialize', 'users');
    }

    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if (!$this->Users->save($user)) {
                return $this->response->withStringBody(json_encode([
                    'message' => 'The user could not be saved. Please, try again.',
                    'errors' => $user->getErrors(),
                ]));
            }
        }

        return $this->response->withStatus(201)->withStringBody(json_encode($user));
    }
}
