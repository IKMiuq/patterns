<?php

namespace generative;

final class Singleton
{
    private static ?self $instance = null;
    private static string $name;
    public static function selfName(string $name):void
    {
        self::$name = $name;
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function __clone():void
    {
        // FIXME: Implement __clone() method.
    }
    public function __wakeup():void
    {
        // FIXME: Implement __wakeup() method.
    }
}