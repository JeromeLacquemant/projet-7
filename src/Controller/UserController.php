<?php

namespace App\Controller;

use App\Services\LoaderInterface;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class UserController
{
    private $loader;

    public function __construct(LoaderInterface $loader) 
    {
        $this->loader = $loader;
    }

     /**
     * @Route("/all-users", name="see_all_users")
     */
    public function seeUsers()
    {
        $response = new Response($this->loader->loadAll());
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
     * @Route("/users/modify/{id}", name="modify_user", methods={"PUT"})
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

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/users/delete/{id}", name="delete_user", methods={"DELETE"})
     */
    public function deleteUser($id, UserRepository $repo)
    {
        $user = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }
}
