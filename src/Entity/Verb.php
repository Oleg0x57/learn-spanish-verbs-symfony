<?php

namespace App\Entity;

use App\Repository\VerbRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VerbRepository::class)
 */
class Verb
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
    private $infinitivo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modoIndicativo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $preteritoSimple;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInfinitivo(): ?string
    {
        return $this->infinitivo;
    }

    public function setInfinitivo(string $infinitivo): self
    {
        $this->infinitivo = $infinitivo;

        return $this;
    }

    public function getModoIndicativo(): ?string
    {
        return $this->modoIndicativo;
    }

    public function setModoIndicativo(string $modoIndicativo): self
    {
        $this->modoIndicativo = $modoIndicativo;

        return $this;
    }

    public function getPreteritoSimple(): ?string
    {
        return $this->preteritoSimple;
    }

    public function setPreteritoSimple(string $preteritoSimple): self
    {
        $this->preteritoSimple = $preteritoSimple;

        return $this;
    }
}
