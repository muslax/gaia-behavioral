<?php

namespace Gaia\Behavioral\Samples;

use Gaia\Behavioral\Workbook;

class SimpleWorkbook extends Workbook
{
    public static function createFromXmlFile($path) : Workbook
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
