<?php

namespace structural;

interface Formatter
{
    public function format($str);
}
class Text implements Formatter
{
    public function format($str): string
    {
        return $str;
    }

}

class HTMLText implements Formatter
{
    public function format($str): string
    {
        return "<p>$str</p>";
    }

}

abstract class BridgeService
{
    public Formatter $formatter;

    /**
     * @param Formatter $formatter
     */
    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    abstract public function getFormatter($str): string;
}

class SimpleTextService extends BridgeService
{
    public function getFormatter($str): string
    {
        return $this->formatter->format($str);
    }
}
class HTMLTextService extends BridgeService
{
    public function getFormatter($str): string
    {
        return $this->formatter->format($str);
    }
}

$simpleText = new Text();
$htmlText = new HTMLText();

$simpleTextService = new SimpleTextService($simpleText);
$htmlTextService = new HTMLTextService($htmlText);


var_dump($simpleTextService->getFormatter('Hello'));
var_dump($htmlTextService->getFormatter('Buy'));