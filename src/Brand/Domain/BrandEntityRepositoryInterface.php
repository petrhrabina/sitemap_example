<?php

namespace App\Brand\Domain;

interface BrandEntityRepositoryInterface
{
    public function findAll(): array;
}