<?php

namespace App\Controller;

use App\Interfaces\ProductsServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    public function __construct(public ProductsServiceInterface $productsService)
    {
    }

    #[Route('/products', name: 'products_index', methods: ['get'])]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $this->productsService->all(),
        ]);
    }

    #[Route('/products', name: 'product_create', methods: ['post'])]
    public function add(Request $request): Response
    {
        $this->productsService->create($request);

        return $this->redirectToRoute('products_index');
    }

    #[Route('/products/delete/{id}', name: 'product_delete', methods: ['post'])]
    public function remove(int $id): Response
    {
        $this->productsService->destroy($id);

        return $this->redirectToRoute('products_index');
    }
}
