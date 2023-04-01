<?php

namespace App\Controller;

use App\Entity\Birds;
use App\Form\BirdsType;
use App\Repository\BirdsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/birds')]
class ApiBirdsController extends AbstractController
{
    #[Route('/list', name: 'app_apibirds_index', methods: ['GET'])]
    public function index(BirdsRepository $birdsRepository): Response
    {
        $birds = $birdsRepository->findAll();
        $data = [];
        foreach ($birds as $bird) {
            $data[] = [
                'id' => $bird->getId(),
                'name' => $bird->getName(),
                'description' => $bird->getDescription(),
                'image' => $bird->getImage(),
                'song' => $bird->getSong(),
                'link' => $bird->getLink(),
            ];
        }
        return $this->json($data);
    }
}
