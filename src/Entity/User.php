<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     *  @ORM\Column(type="string", length=200, nullable=true)
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $apellidos;



    /**
     * @ORM\Column(type="string", length=100)
     */

    private $telefono;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $foto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Foto", mappedBy="idUsuario")
     */
    private $fotos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provincia", inversedBy="usuarios",cascade={"persist", "remove"}))
     */
    private $provincia;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Anuncio", mappedBy="user")
     */
    private $anuncios;



    public function __construct()
    {
        $this->fotos = new ArrayCollection();
        $this->usuario = new ArrayCollection();
        $this->anuncios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

  

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

  
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_USER';

        return array($roles); //array_unique($roles);
        
    }

    public function setRoles($roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Anuncio[]
     */
    public function getAnuncios(): Collection
    {
        return $this->anuncios;
    }

    public function addAnuncio(Anuncio $anuncio): self
    {
        if (!$this->anuncios->contains($anuncio)) {
            $this->anuncios[] = $anuncio;
            $anuncio->setUser($this);
        }

        return $this;
    }

    public function removeAnuncio(Anuncio $anuncio): self
    {
        if ($this->anuncios->contains($anuncio)) {
            $this->anuncios->removeElement($anuncio);
            // set the owning side to null (unless already changed)
            if ($anuncio->getUser() === $this) {
                $anuncio->setUser(null);
            }
        }

        return $this;
    }

  
}
