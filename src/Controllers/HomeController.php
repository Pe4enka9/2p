<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $events = ORM::forTable('events')->findMany();
        return $this->renderer->render($response, 'index.php', [
            'events' => $events
        ]);
    }
}