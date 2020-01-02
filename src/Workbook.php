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
 * Abstract class that provides general Workbook features.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
abstract class Workbook
{
    private \DOMDocument $dom;
    
    private \DOMElement $docroot;
    
    private \DOMXPath $xpath;
    
    protected function __construct() { }
    
    /**
     * Create Workbook instance from XML file.
     *
     * @return Workbook object
     * @param string $path
     *
     * @throws \Exception
     */
    protected abstract static function createFromXmlFile($path);
    
    /**
     * Inits...
     *
     * @return void
     * @param DOMDocument
     */
    protected function init(\DOMDocument $dom)
    {
        $this->dom = $dom;
        $this->xpath = new \DOMXPath($dom);
        $this->documentElement = $dom->documentElement;
        $doc = $dom->documentElement;
    }
    
    /**
     * Returns DOMDocument from the XML Workbook
     *
     * @return DOMDocument
     */
    public function getDOM() : \DOMDocument
    {
        return $this->dom;
    }
    
    /**
     * Returns the root of the XML Workbook.
     *
     * @return DOMElement
     */
    public function getDocumentElement() : \DOMElement
    {
        return $this->documentElement;
    }
    
    /**
     * Returns DOMXPath object.
     *
     * @return DOMXPath
     */
    public function getXPath() : \DOMXPath
    {
    }
} // END abstract class Workbook