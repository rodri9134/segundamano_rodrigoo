<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FotoRepository")
 */
class Foto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nombre;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Anuncio", inversedBy="fotos")
     */
    private $anuncio;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }



    public function getAnuncio(): ?Anuncio
    {
        return $this->anuncio;
    }

    public function setAnuncio(?Anuncio $anuncio): self
    {
        $this->anuncio = $anuncio;

        return $this;
    }

  




 
}
