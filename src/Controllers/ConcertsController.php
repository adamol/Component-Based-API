<?php

namespace App\Controllers;

use App\Repositories\ConcertRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConcertsController
{
    public function show($id, ConcertRepository $concertRepository)
    {
        $concert = $concertRepository->findBy('id', $id);

        return new JsonResponse($concert->toArray());
    }
}