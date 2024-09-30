<?php

namespace App\Brand\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BrandController extends AbstractController
{
    public function show(string $slug): JsonResponse
    {
        return $this->json([
            'slug' => $slug,
        ]);
    }
}
