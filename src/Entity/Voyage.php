<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $LieuDepart = null;

    #[ORM\Column(length: 255)]
    private ?string $LieuArrive = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateDepart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateArrive = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLieuDepart(): ?string
    {
        return $this->LieuDepart;
    }

    public function setLieuDepart(string $LieuDepart): static
    {
        $this->LieuDepart = $LieuDepart;

        return $this;
    }

    public function getLieuArrive(): ?string
    {
        return $this->LieuArrive;
    }

    public function setLieuArrive(string $LieuArrive): static
    {
        $this->LieuArrive = $LieuArrive;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->DateDepart;
    }

    public function setDateDepart(\DateTimeInterface $DateDepart): static
    {
        $this->DateDepart = $DateDepart;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->DateArrive;
    }

    public function setDateArrive(\DateTimeInterface $DateArrive): static
    {
        $this->DateArrive = $DateArrive;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }
    public function setImage(?UploadedFile $image): self
    {
        if ($image) {
            $this->image = file_get_contents($image->getPathname());
        }
    
        return $this;
    }
    

  
    public function displayPhoto()
    {
            $this->image = "data:image/png;base64," . base64_encode(stream_get_contents($this->getImage()));
            return $this->image;
    }
}
