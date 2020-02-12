<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnuncioRepository")
 */
class Anuncio
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
    private $titulo;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $precio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_crea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_mod;

   

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Foto", mappedBy="anuncio",cascade={"persist", "remove"})
     */
    private $fotos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fotoPrincipal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="anuncios")
     */
    private $user;




    public function __construct()
    {
        $this->fotos = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }


    public function setPrecio(string $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getFechaCrea(): ?\DateTimeInterface
    {
        return $this->fecha_crea;
    }

    public function setFechaCrea(\DateTimeInterface $fecha_crea): self
    {
        $this->fecha_crea = $fecha_crea;

        return $this;
    }

    public function getFechaMod(): ?\DateTimeInterface
    {
        return $this->fecha_mod;
    }

    public function setFechaMod(\DateTimeInterface $fecha_mod): self
    {
        $this->fecha_mod = $fecha_mod;

        return $this;
    }



 
    /**
     * @return Collection|Foto[]
     */
    public function getFotos(): Collection
    {
        return $this->fotos;
    }

    public function addFoto(Foto $foto): self
    {
        if (!$this->fotos->contains($foto)) {
            $this->fotos[] = $foto;
            $foto->setAnuncio($this);
        }

        return $this;
    }

    public function removeFoto(Foto $foto): self
    {
        if ($this->fotos->contains($foto)) {
            $this->fotos->removeElement($foto);
            // set the owning side to null (unless already changed)
            if ($foto->getAnuncio() === $this) {
                $foto->setAnuncio(null);
            }
        }

        return $this;
    }

    public function getFotoPrincipal(): ?string
    {
        return $this->fotoPrincipal;
    }

    public function setFotoPrincipal(string $fotoPrincipal): self
    {
        $this->fotoPrincipal = $fotoPrincipal;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }




  

   
}
