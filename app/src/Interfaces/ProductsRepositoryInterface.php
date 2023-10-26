<?php

namespace App\Interfaces;

use App\Entity\Product;

interface ProductsRepositoryInterface
{
    public function allProducts(): array;

    public function findById(int $id): ?Product;
}
