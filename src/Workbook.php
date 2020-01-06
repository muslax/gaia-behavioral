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

/**
 * Abstract class that provides general WorkBook features.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
abstract class WorkBook
{
    private \DOMDocument $dom;
    
    // private \DOMElement $docroot;
    
    // private \DOMXPath $xpath;
    
    protected function __construct() { }
    
    protected function validate(\DOMDocument $dom)
    {
        $doc = $dom->documentElement;
        $xpath = $this->getXPath();
        
        // It has to be WorkBook and has id
        if ($doc->nodeName != 'WorkBook') return false;
        if (strlen($doc->getAttribute('id')) < 16) return false;
    }
    
    /**
     * Create WorkBook instance from XML file.
     *
     * @return WorkBook object
     * @param string $path
     *
     * @throws \Exception
     */
    protected abstract static function createFromXmlFile($path) : WorkBook;
    
    /**
     * Inits...
     *
     * @return void
     * @param DOMDocument
     */
    protected function init(\DOMDocument $dom)
    {
        $this->dom = $dom;
        // $this->xpath = new \DOMXPath($dom);
        // $this->documentElement = $dom->documentElement;
        // $doc = $dom->documentElement;
    }
    
    /**
     * Returns DOMDocument from the XML WorkBook
     *
     * @return DOMDocument
     */
    public function getDOM() : \DOMDocument
    {
        return $this->dom;
    }
    
    /**
     * Returns the root of the XML WorkBook.
     *
     * @return DOMElement
     */
    public function getDocumentElement() : \DOMElement
    {
        return $this->dom->documentElement;
    }
    
    /**
     * Returns DOMXPath object.
     *
     * @return DOMXPath
     */
    public function getXPath() : \DOMXPath
    {
        if (! isset($this->xpath)) {
            $this->xpath = new \DOMXPath($this->dom);
        }
        return $this->xpath;
    }
} // END abstract class WorkBook
