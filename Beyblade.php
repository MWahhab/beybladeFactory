<?php

class Beyblade
{
    /**
     * @var int    $id          Refers to the beyblade's ID
     */
    private int    $id;
    /**
     * @var string $name        Refers to the beyblade's name
     */
    private string $name;
    /**
     * @var string $specialMove Refers to the beyblade's special move
     */
    private string $specialMove;
    /**
     * @var string $type        Refers to the beyblade's type
     */
    private string $type;
    /**
     * @var string $owner       Refers to the beyblade's owner
     */
    private string $owner;

    /**
     * @param int    $id          Refers to the beyblade's ID
     * @param string $name        Refers to the beyblade's name
     * @param string $specialMove Refers to the beyblade's special move
     * @param string $type        Refers to the beyblade's type
     * @param string $owner       Refers to the beyblade's owner
     *
     * Upon instantiation, sets the beyblade's properties to the inputted values
     */
    public function __construct(string $name, string $specialMove, string $type, string $owner)
    {
        $this->name        = $name;
        $this->specialMove = $specialMove;
        $this->type        = $type;
        $this->owner       = $owner;
    }

    /**
     * @return int Retrieves the beyblade's ID
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string Retrieves the beyblade's ID
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string Retrieves the beyblade's ID
     */
    public function getSpecialMove(): string
    {
        return $this->specialMove;
    }

    /**
     * @return string Retrieves the beyblade's ID
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string Retrieves the beyblade's ID
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param  int $id Refers to the beyblade's ID
     * @return void    Sets the beyblade's ID
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

}