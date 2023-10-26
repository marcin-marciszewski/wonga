<?php

namespace App\Services;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use App\Interfaces\ProductsServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Interfaces\ProductsRepositoryInterface;


class ProductService implements ProductsServiceInterface
{
    private $products;
    private $entityManager;
    public function __construct(ProductsRepositoryInterface $productsRepository, ManagerRegistry $doctrine)
    {
        $this->products = $productsRepository;
        $this->entityManager = $doctrine->getManager();
    }

    public function all(): array
    {
        return $this->products->allProducts();
    }

    public function create(Request $request): void
    {
        $keyValuePairs = explode('&', $request->getContent());
        $data = [];
        foreach ($keyValuePairs as $pair) {
            list($key, $value) = explode('=', $pair);
            $data[$key] = $value;
        }
        $newProduct = (object)$data;

        $product = new Product();
        $product->setName((string)$newProduct->name);
        $product->setStock((int)$newProduct->stock);
        $product->setNetPrice((int)$newProduct->net_price);
        $product->setGrossPrice((int)$newProduct->gross_price);
        $product->setVatRate((int)$newProduct->vat_rate);

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function destroy($id): void
    {
        $product = $this->products->findById($id);

        if (!$product) {
            throw new \InvalidArgumentException("A product with id $id does not exists.");
        }

        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }
}
