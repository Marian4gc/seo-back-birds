<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post', methods: ['POST'])]
    public function likeBird(Request $request, EntityManagerInterface $entityManager, PostRepository $postRepository): Response
    {

        $result = $postRepository->findAll();
        // dump($result);
        $post = [];

        foreach ( $result as $r) {
            $post[] = [
                'id' => $r->getId(),
                'name' => $r->getName(),
            ];
        }


        $data = json_decode($request->getContent(), true);
        if (isset($data['name'])) {
            $name = $data['name'];
            $bird = new Post();
            $bird->setName($name);
            $entityManager->persist($bird);
        }

        $bird = new Post();
        $bird->setName('');

        $entityManager->persist($bird);
        $entityManager->flush();

        return $this->json($post, $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*']);

    }
}
