<?php

namespace App\Entity\Verb;

use App\Enum\Verb\TimeTypes;
use App\Repository\Verb\TimeFormRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimeFormRepository::class)
 * 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 * "modo_indicativo" = "ModoIndicativo",
 * "preterito_simple" = "PreterioSimple"
 * })
 */
abstract class AbstractTimeForm
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
    private $yo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $el;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ella;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usted;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nosotros;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vosotros;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ellos;

    /**
     * @ORM\ManyToOne(targetEntity=Infinitivo::class, inversedBy="timeForms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $infinitivo;

    abstract public static function getTimeType(): string;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYo(): ?string
    {
        return $this->yo;
    }

    public function setYo(string $yo): self
    {
        $this->yo = $yo;

        return $this;
    }

    public function getTu(): ?string
    {
        return $this->tu;
    }

    public function setTu(string $tu): self
    {
        $this->tu = $tu;

        return $this;
    }

    public function getEl(): ?string
    {
        return $this->el;
    }

    public function setEl(string $el): self
    {
        $this->el = $el;

        return $this;
    }

    public function getElla(): ?string
    {
        return $this->ella;
    }

    public function setElla(string $ella): self
    {
        $this->ella = $ella;

        return $this;
    }

    public function getUsted(): ?string
    {
        return $this->usted;
    }

    public function setUsted(string $usted): self
    {
        $this->usted = $usted;

        return $this;
    }

    public function getNosotros(): ?string
    {
        return $this->nosotros;
    }

    public function setNosotros(string $nosotros): self
    {
        $this->nosotros = $nosotros;

        return $this;
    }

    public function getVosotros(): ?string
    {
        return $this->vosotros;
    }

    public function setVosotros(string $vosotros): self
    {
        $this->vosotros = $vosotros;

        return $this;
    }

    public function getEllos(): ?string
    {
        return $this->ellos;
    }

    public function setEllos(string $ellos): self
    {
        $this->ellos = $ellos;

        return $this;
    }

    public function getInfinitivo(): ?Infinitivo
    {
        return $this->infinitivo;
    }

    public function setInfinitivo(?Infinitivo $infinitivo): self
    {
        $this->infinitivo = $infinitivo;

        return $this;
    }
}
