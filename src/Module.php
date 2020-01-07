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
    
    private string $xmlURI;
    
    private string $rngURI;
    
    private array $propertyBag;
    
    private array $xmlErrors;
    
    private array $elements;
    
    /** property accessors */
    
    public function getProperty(string $prop) : ?mixed
    {
        
    }
    
    public function getModuleType() : int
    {
        
    }
    
    
    
    
    private WorkBook $book;
    
    private array $meta;
    
    private array $elements;
    
    private string $intro;
    
    private array $sections;
    
    
    private string $_id;
    private string $_source;
    private string $_releaseDate;
    private string $_moduleName;
    private string $_moduleTitle;
    private string $_moduleVersion;
    private string $_workbookType;
    private string $_evidenceType;
    private string $_optionsMode;
    private int    $_optionsNums;
    private int    $_optionsSelect;
    private int    $_testItems;
    
    private array $bookMeta = [];
    
    private array $elements;
    
    private function init_books()
    {
        $dom = $this->book->getDOM();
        $doc = $dom->documentElement;
        
        $this->_id = $doc->getAttribute('id');
        $this->_source = $dom->documentURI;
        $this->_releaseDate = $doc->getAttribute('releaseDate');
        $this->_moduleName = $doc->getAttribute('moduleName');
        $this->_moduleTitle = $doc->getAttribute('moduleTitle');
        $this->_moduleVersion = $doc->getAttribute('moduleVersion');
        $this->_workbookType = $doc->getAttribute('workbookType');
        $this->_evidenceType = $doc->getAttribute('evidenceType');
        $this->_optionsMode = $doc->getAttribute('optionsMode');
        $this->_optionsNums = intval($doc->getAttribute('optionsNums'));
        $this->_optionsSelect = intval($doc->getAttribute('optionsSelect'));
        $this->_testItems = intval($doc->getAttribute('testItems'));
    }
    
    protected function __construct($book = null)
    {
        if ($book instanceof WorkBook) {
            $this->book = $book;
            $this->init_books();
        }
    }
    
    /**
     * Set or change workbook for this module.
     *
     * @return Module object
     * @param WorkBook $book
     *
     * @throws \Exception
     */
    public function setWorkBook(WorkBook $book) : Module
    {
        if (! $book instanceof WorkBook) {
            throw new \Exception("Bukan WorkBook yang diberikan.");
        }
        $this->book = $book;
        $this->init_books();
        return $this;
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
