<?php

namespace App\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface ProductsServiceInterface
{
    public function all(): array;

    public function create(Request $request): void;

    public function destroy($id): void;
}
