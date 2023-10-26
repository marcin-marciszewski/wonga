<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column]
    private ?int $net_price = null;

    #[ORM\Column]
    private ?int $gross_price = null;

    #[ORM\Column]
    private ?int $vat_rate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getNetPrice(): ?int
    {
        return $this->net_price;
    }

    public function setNetPrice(int $net_price): void
    {
        $this->net_price = $net_price;
    }

    public function getGrossPrice(): ?int
    {
        return $this->gross_price;
    }

    public function setGrossPrice(int $gross_price): void
    {
        $this->gross_price = $gross_price;
    }

    public function getVatRate(): ?int
    {
        return $this->vat_rate;
    }

    public function setVatRate(int $vat_rate): void
    {
        $this->vat_rate = $vat_rate;
    }
}
