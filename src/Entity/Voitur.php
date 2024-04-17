<?php

namespace App\Entity;

use App\Repository\VoiturRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoiturRepository::class)
 */
class Voitur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $col;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCol(): ?string
    {
        return $this->col;
    }

    public function setCol(string $col): self
    {
        $this->col = $col;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function countCarsWithSameColorAndModel(VoiturRepository $repository): int
    {
        try {
            $count = 0;
            $allCars = $repository->findAll();

            foreach ($allCars as $car) {
                if ($car->getCol() === $this->col && $car->getModel() === $this->model) {
                    $count++;
                }
            }

            return $count;
        } catch (\Exception $e) {
            throw new \Exception("Error counting cars: " . $e->getMessage());
        }
    }
}

