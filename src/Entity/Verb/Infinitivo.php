<?php

namespace App\Entity\Verb;

use App\Enum\Verb\TimeTypes;
use App\Repository\Verb\InfinitivoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InfinitivoRepository::class)
 */
class Infinitivo
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=AbstractTimeForm::class, mappedBy="infinitivo", orphanRemoval=true)
     */
    private $timeForms;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRegular;

    public function __construct()
    {
        $this->timeForms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|AbstractTimeForm[]
     */
    public function getTimeForms(): Collection
    {
        return $this->timeForms;
    }

    public function addTimeForm(AbstractTimeForm $timeForm): self
    {
        if (!$this->timeForms->contains($timeForm)) {
            $this->timeForms[] = $timeForm;
            $timeForm->setInfinitivo($this);
        }

        return $this;
    }

    public function removeTimeForm(AbstractTimeForm $timeForm): self
    {
        if ($this->timeForms->removeElement($timeForm)) {
            // set the owning side to null (unless already changed)
            if ($timeForm->getInfinitivo() === $this) {
                $timeForm->setInfinitivo(null);
            }
        }

        return $this;
    }

    public function hasModoIndicativo(): bool
    {
        foreach ($this->getTimeForms() as $verbForm) {
            if ($verbForm->getTimeType() === TimeTypes::MODO_INDICATIVO) {
                return true;
            }
        }
        
        return false;
    }

    public function hasPreterioSimple(): bool
    {
        foreach ($this->getTimeForms() as $verbForm) {
            if ($verbForm->getTimeType() === TimeTypes::PRETERIO_SIMPLE) {
                return true;
            }
        }
        
        return false;
    }

    public function hasFuturoSimple(): bool
    {
        foreach ($this->getTimeForms() as $verbForm) {
            if ($verbForm->getTimeType() === TimeTypes::FUTURO_SIMPLE) {
                return true;
            }
        }
        
        return false;
    }

    public function hasFuturoProximo(): bool
    {
        foreach ($this->getTimeForms() as $verbForm) {
            if ($verbForm->getTimeType() === TimeTypes::FUTURO_PROXIMO) {
                return true;
            }
        }
        
        return false;
    }

    public function getIsRegular(): ?bool
    {
        return $this->isRegular;
    }

    public function setIsRegular(bool $isRegular): self
    {
        $this->isRegular = $isRegular;

        return $this;
    }
}
