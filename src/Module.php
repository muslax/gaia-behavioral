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
use Gaia\Behavioral\Workbook;

use \DOMDocument;

/**
 * Class that define Behavioral Module.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
abstract class Module
{
    protected int   $type; // GB_MOD_INTRAY GB_MOD_CSI
    
    private array   $properties = [];
    
    private array   $xmlErrors = [];
    
    private array   $elements;
    
    private string  $xmlURI;
    
    private string  $schemaURI;
    
    private bool    $xmlIsValid = false;
    
    private bool    $schemaIsValid = false;
    
    private bool    $workbookIsValid = false;
    
    
    // protected function __construct()
    // {
    //
    // }
    
    
    /**
     * Returns module type.
     *
     */
    public function getType() : int
    {
        return $this->type;
    }
    
    public function getProperties() : array
    {
        return $this->properties ? $this->properties : [];
    }
    
    public function getElements() : array
    {
        return $this->elements ? $this->elements : [];
    }
    
    public function getXmlURI() : ?string
    {
        return $this->xmlURI ? $this->xmlURI : null;
    }
    
    public function getSchemaURI() : ?string
    {
        return $this->schemaURI ? $this->schemaURI : null;
    }
    
    public function getXmlErrors() : array
    {
        return $this->xmlErrors ? $this->xmlErrors : [];
    }
    
    public function getClientWorkbook(string $format = 'JSON') : string
    {
        return Workbook::createClientJSONWorkbook($this->xmlURI);
    }
    
    public function isXmlValid() : bool
    {
        return $this->xmlIsValid;
    }
    
    public function isSchemaValid() : bool
    {
        return $this->schemaIsValid;
    }
    
    public function isWorkbookValid() : bool
    {
        return $this->workbookIsValid;
    }
    
    public function setWorkbook(string $xmlURI)
    {
        $this->xmlURI = $xmlURI;
        
        if ($this->checkXml($xmlURI)) {
            $this->xmlIsValid = true;
            if ($this->schemaIsValid) {
                $this->workbookIsValid = $this->validateWorkbook();
            }
        } else {
            $this->xmlIsValid = false;
            $this->workbookIsValid = false;
        }
    }
    
    public function setSchema(string $schemaURI)
    {
        $this->schemaURI = $schemaURI;
        
        if ($this->checkXml($schemaURI)) {
            $this->schemaIsValid = true;
            if ($this->xmlIsValid) {
                $this->workbookIsValid = $this->validateWorkbook();
            }
        } else {
            $this->schemaIsValid = false;
            $this->workbookIsValid = false;
        }
    }
    
    protected function validateWorkbook()
    {
        $this->xmlErrors = [];
        
        Workbook::validateAndPopulate(
            $this->xmlURI,
            $this->schemaURI,
            $this->properties,
            $this->xmlErrors
        );
        
        // echo "ERRORS: ". count($this->xmlErrors) . "\n";
        return count($this->xmlErrors) == 0;
    }
    
    private function checkXml($uri)
    {
        if (! file_exists($uri)) {
            $this->xmlErrors[] = "File not found: ". $uri;
            return false;
        }
        
        // https://stackoverflow.com/questions/1241728/can-i-try-catch-a-warning
        
        set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        
        try {
            $dom = new \DOMDocument();
            if ($dom->load($uri)) {
                return true;
            }
        } catch (\ErrorException $e) {
            $this->xmlErrors[] = 'Error ['. $e->getCode(). ']: '. $e->getMessage();
        }
        
        restore_error_handler();
        
        return false;
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
     * Generates report.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return void
     * @param what
     */
    public abstract function generateReport(Evidence $evidence, array $options = []) : ?object;
} // END abstract class Module
