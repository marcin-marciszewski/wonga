<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/', name: 'api_')]
class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_index', methods: ['get'])]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $products = $doctrine
            ->getRepository(Product::class)
            ->findAll();

        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'stock' => $product->getStock(),
                'net_price' => $product->getNetPrice(),
                'gross_price' => $product->getGrossPrice(),
                'vat_rate' => $product->getVatRate(),
            ];
        }

        return $this->json($data);
    }


    #[Route('/products', name: 'product_create', methods: ['post'])]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        $requestData = json_decode($request->getContent());

        if (!$requestData) {
            return $this->json(['error' => 'Invalid request data'], 400);
        }

        $newProduct = $requestData->product;

        if (empty($newProduct->name)) {
            return $this->json(['error' => 'Name can not be empty'], 400);
        }

        $product = new Product();
        $product->setName((string)$newProduct->name);
        $product->setStock((int)$newProduct->stock);
        $product->setNetPrice((int)$newProduct->net_price);
        $product->setGrossPrice((int)$newProduct->gross_price);
        $product->setVatRate((int)$newProduct->vat_rate);

        $entityManager->persist($product);
        $entityManager->flush();

        $data =  [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'stock' => $product->getStock(),
            'net_price' => $product->getNetPrice(),
            'gross_price' => $product->getGrossPrice(),
            'vat_rate' => $product->getVatRate(),
        ];

        return $this->json($data);
    }

    #[Route('/products/{id}', name: 'product_delete', methods: ['delete'])]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            return $this->json(['error' => 'No product found for id ' . $id], 404);
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->json('Deleted a product successfully with id ' . $id);
    }
}
