<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ClientController.php',
        ]);
    }

    /**
     * @Route("/all-clients", name="see_all_clients")
     */
    public function seeClients(ClientRepository $repo)
    {
        $clients = $repo->findAll();

        $data = $this->get('serializer')->serialize($clients, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/clients/{id}", name="see_one_client")
     */
    public function seeClient($id, ClientRepository $repo)
    {
        $client = $repo->find($id);

        $data = $this->get('serializer')->serialize($client, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
