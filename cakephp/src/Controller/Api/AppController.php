<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(EventInterface $event) 
    {
        parent::beforeFilter($event);

        $this->RequestHandler->renderAs($this, 'json');
    }
}
