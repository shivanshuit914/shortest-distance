<?php

class User
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Repository[]
     */
    private $repositories;

    private function __construct(string  $name)
    {
        $this->name = $name;
    }

    public static function withName(string $name) : User
    {
        return new static($name);
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function contributedTo(array $repositories)
    {
        $this->repositories = $repositories;
    }

    /**
     * @return Repository[]
     */
    public function getContributedRepositories() : array
    {
        return $this->repositories;
    }
}
