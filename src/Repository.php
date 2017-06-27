<?php

class Repository
{
    /**
     * @var string
     */
    private $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function withName(string $name) : Repository
    {
        return new static($name);
    }

    public function getName() : string
    {
        return $this->name;
    }
}
