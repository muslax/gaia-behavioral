<?php

namespace Gaia\Behavioral\Samples;

use Gaia\Behavioral\Module;
use Gaia\Behavioral\Evidence;

class SimpleModule extends Module    
{
    public function __construct($book = null)
    {
        parent::__construct($book);
        // if ($book instanceof WorkBook) {
        //     $this->book = $book;
        //     $this->init_books();
        // }
    }
    
    public function score(Evidence $evidence) : array
    {
        return ['SCORE' => 'TEST'];
    }
    
    public function generateWorkBook(Evidence $evidence, array $options = []) : SimpleWorkBook
    {
        return $this->book;
    }
    
    public function generateReport(Evidence $evidence, array $options = []) : object
    {
        return $this->book;
    }
}
