<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $events = ORM::forTable('events')
            ->select('events.*')
            ->selectExpr('events.places - SUM(applications.places)', 'places_diff')
            ->leftOuterJoin('applications', 'events.id = applications.event_id')
            ->groupBy('events.id')
            ->findMany();

        return $this->renderer->render($response, 'index.php', [
            'events' => $events
        ]);
    }
    public function show(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $event = ORM::forTable('events')->findOne($id);
        return $this->renderer->render($response, 'show.php', [
            'event' => $event
        ]);
    }

    public function create(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $event = ORM::forTable('events')->findOne($id);
        return $this->renderer->render($response, 'create.php', [
            'event' => $event
        ]);
    }

    public function store(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $event = ORM::forTable('events')
            ->select('events.*')
            ->selectExpr('events.places - SUM(applications.places)', 'places_diff')
            ->leftOuterJoin('applications', 'events.id = applications.event_id')
            ->groupBy('events.id')
            ->findOne($id);
        $placesCount = $event['places'] - $event['places_diff'];

        if ($placesCount < $request->getParsedBody()['places']) {
            $this->flash->addMessage('error', 'Доступно мест: ' . $event['places_diff']);
            return $response->withHeader('Location', "/event/$id/book")->withStatus(302);
        }

        ORM::forTable('applications')->create([
            'user_name' => $request->getParsedBody()['user_name'],
            'email' => $request->getParsedBody()['email'],
            'places' => $request->getParsedBody()['places'],
            'event_id' => $id,
        ])->save();
        return $response->withHeader('Location', '/')->withStatus(302);
    }
}