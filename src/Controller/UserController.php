<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

     /**
     * @Route("/all-users", name="see_all_users")
     */
    public function seeUsers(UserRepository $repo)
    {
        $users = $repo->findAll();

        $data = $this->get('serializer')->serialize($users, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/users/{id}", name="see_one_user")
     */
    public function seeUser($id, UserRepository $repo)
    {
        $user = $repo->find($id);

        $data = $this->get('serializer')->serialize($user, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/users/add-new-user", name="add_user", methods={"POST"})
     */
    public function addUser(Request $request)
    {
        $data = $request->getContent();
        $user = $this->get('serializer')
            ->deserialize($data, 'App\Entity\User', 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/users/modify-user/{id}", name="modify_user", methods={"PUT"})
     */
    public function modifyUser($id, UserRepository $repo, Request $request)
    {
        $user = $repo->find($id);

        $user
            ->setUsername("Francis")
            ->setPassword("passwordtest")
            ->setEmail("fake@email.com");

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        //dd($user);
        return new Response('', Response::HTTP_CREATED);
    }
}
