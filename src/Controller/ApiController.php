<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController
{
    /**
     * @Route("/birds", methods={"POST, GET"})
     */
    public function postBirds(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        // Procesa los datos como sea necesario
        $selectedBirdsNames = $data['selectedBirdsNames'];

        // Devuelve los datos recibidos en la respuesta
        return new JsonResponse($selectedBirdsNames);
    }
}
