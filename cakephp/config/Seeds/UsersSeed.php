<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\Http\Client;
use Cake\I18n\FrozenTime;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = $this->prepareUsers();

        $table = $this->table('users');
        $table->truncate();
        
        $table->insert($data)->save();
    }

    private function prepareUsers() 
    {
        $http = new Client();
        $users = [];

        $response = $http->get('https://dummyjson.com/users');
        $dummyUsers = $response->getJson()['users'] ?? [];

        foreach ($dummyUsers as $user) {
            $users[] = [
                'username' => $user['username'],
                'email' => $user['email'],
                'name' => $user['firstName'] . ' ' . $user['lastName'],
                'age' => $user['age'],
                'created' => FrozenTime::now()->format('Y-m-d H:i:s'),
                'modified' => FrozenTime::now()->format('Y-m-d H:i:s'),
            ];
        }

        return $users;
    }
}
