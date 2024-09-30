<?php

namespace App\Blog\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BlogController extends AbstractController
{
    public function show(string $slug): JsonResponse
    {
        return $this->json([
            'slug' => $slug,
        ]);
    }
}
