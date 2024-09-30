<?php

namespace App\Blog\Domain;

interface BlogEntityRepositoryInterface
{
    public function findAll(): array;
}