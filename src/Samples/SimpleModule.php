<?php

namespace Gaia\Behavioral\Samples;

use Gaia\Behavioral\Module;
use Gaia\Behavioral\Evidence;

class SimpleModule extends Module    
{
    // public function __construct($book = null)
    // {
    //     parent::__construct($book);
    //     // if ($book instanceof Workbook) {
    //     //     $this->book = $book;
    //     //     $this->init_books();
    //     // }
    // }
    
    public function score(Evidence $evidence) : array
    {
        return ['SCORE' => 'TEST'];
    }
    
    public function generateWorkbook(Evidence $evidence, array $options = []) : ?object
    {
        return null;
    }
    
    public function generateReport(Evidence $evidence, array $options = []) : ?object
    {
        return null;
    }
}
