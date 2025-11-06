<?php
/** Компоновщик */

namespace structural;

interface Renderable
{
    /**
     * @return string
     */
    public function render(): string;
}

class CompositeMail implements Renderable
{
    /**
     * @var array
     */
    private array $parts = [];

    /**
     * @return string
     */
    public function render(): string
    {
        $result = '';
        foreach ($this->parts as $part) {
            $result .= $part->render();
        }
        return $result;
    }

    /**
     * @param Renderable $part
     * @return void
     */
    public function addPart(Renderable $part): void
    {
        $this->parts[] = $part;
    }
}


abstract class Part
{
    /**
     * @var string
     */
    private string $text;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = PHP_EOL . $text;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

}

class Header extends Part implements Renderable
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<header>' . $this->getText() . '</header>';
    }
}

class Body extends Part implements Renderable
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<b>' . $this->getText() . '</b>';
    }
}

class Footer extends Part implements Renderable
{
    /**
     * @return string
     */
    public function render(): string
    {
        return '<footer>' . $this->getText() . '</footer>';
    }
}

$mail = new CompositeMail();
$mail->addPart(new Header('Header'));
$mail->addPart(new Body('Body'));
$mail->addPart(new Footer('Footer'));
var_dump($mail->render());