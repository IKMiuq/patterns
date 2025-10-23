<?php

namespace generative;

final class Singleton
{
    private static ?self $instance = null;
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public function selfName(): string
    {
        return $this->name;
    }

    public static function getInstance(string $name): self
    {
        if (self::$instance === null) {
            self::$instance = new self($name);
        }

        return self::$instance;
    }

    private function __clone(): void
    {
        // Exception
    }

    public function __wakeup(): void
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}

$singleton = Singleton::getInstance("test");
var_dump($singleton->selfName());