<?php

namespace Gaia\Behavioral\Samples;

use Gaia\Behavioral\WorkBook;

class SimpleWorkBook extends WorkBook
{
    public static function createFromXmlFile($path) : WorkBook
    {
        try {
            $dom = new \DOMDocument();
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            if ($dom->load($path)) {
                $that = new self();
                $that->init($dom);
                return $that;
            }
        } catch (Exception $e) {
            
        }
    }
}
