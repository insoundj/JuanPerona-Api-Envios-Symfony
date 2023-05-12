<?php

namespace App\Entity;

use App\Repository\EnvioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnvioRepository::class)
 */
class Envio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="uuid")
     */
    private $uuid;

    /**
     * @ORM\Column(type="json")
     */
    private $recogida = [];

    /**
     * @ORM\Column(type="json")
     */
    private $destino = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localizador;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vehiculo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getRecogida(): ?array
    {
        return $this->recogida;
    }

    public function setRecogida(array $recogida): self
    {
        $this->recogida = $recogida;

        return $this;
    }

    public function getDestino(): ?array
    {
        return $this->destino;
    }

    public function setDestino(array $destino): self
    {
        $this->destino = $destino;

        return $this;
    }

    public function getLocalizador(): ?string
    {
        return $this->localizador;
    }

    public function setLocalizador(string $localizador): self
    {
        $this->localizador = $localizador;

        return $this;
    }

    public function getVehiculo(): ?string
    {
        return $this->vehiculo;
    }

    public function setVehiculo(string $vehiculo): self
    {
        $this->vehiculo = $vehiculo;

        return $this;
    }
}