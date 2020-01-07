<?php

/**
 * This file is part of the Gaia Behavioral package.
 *
 * @author Arif Muslax <muslax@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gaia\Behavioral;

use Gaia\Behavioral\Element;
use Gaia\Behavioral\Evidence;
use Gaia\Behavioral\WorkBook;

/**
 * Class that define Behavioral Module.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
abstract class Module
{
    private int $type; // GB_MOD_INTRAY GB_MOD_CSI
    
    private array $propertyBag;
    
    private array $xmlErrors;
    
    private array $elements;
    
    private string $xmlURI;
    
    private string $schemaURI;
    
    private bool $validated = false;
    
    
    protected function __construct($book = null)
    {
        
    }
    
    
    /** property accessors */
    
    public function getElements() : array
    {
        return $this->elements;
    }
    
    public function getWorkBookMeta(string $prop) : ?mixed
    {
        return $this->propertyBag[$prop];
    }
    
    public function getAppWorkBook(string $format = 'JSON') : string
    {
        
    }
    

    
    
    
    
    public function validateWorkbook()
    {
        
    }
    
    public function setWorkBook(string $URI)
    {
        
    }
    
    public function setSchema(string $URI)
    {
        
    }
    
    /**
     * Generate elements' score given the evidence.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return array
     * @param Evidence
     */
    public abstract function score(Evidence $evidence) : array;
    
    /**
     * Generate WorkBook object with options.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return object
     * @param mixed
     */
    public abstract function generateWorkBook(Evidence $evidence, array $options = []) : ?object;
    
    /**
     * Generates report.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return void
     * @param what
     */
    public abstract function generateReport(Evidence $evidence, array $options = []) : ?object;
} // END abstract class Module
