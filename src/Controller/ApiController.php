<?php
// src/Controller/ApiController.php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    private $logger;
    private $entityManager;

    public function __construct(LoggerInterface $logger, EntityManagerInterface $entityManager)
    {
        $this->logger = $logger;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/api/birds", name="api_birds", methods={"POST"})
     */
    public function postBirds(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        // verificar si los datos recibidos son válidos
        if (!isset($data['selectedBirdsData']) || !is_array($data['selectedBirdsData'])) {
            return new JsonResponse(['error' => 'Los datos recibidos no son válidos.'], 400);
        }
        
        $selectedBirdsData = $data['selectedBirdsData'];

        // aquí puedes hacer lo que necesites con los datos recibidos
        // por ejemplo, guardarlos en la base de datos

        // devolver una respuesta exitosa
        $response = new JsonResponse(['message' => 'Datos recibidos correctamente.']);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');

        return $response;
    }
}
