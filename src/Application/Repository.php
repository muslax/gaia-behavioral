<?php

/**
 * This file is part of the Gaia Behavioral package.
 *
 * @author Arif Muslax <muslax@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gaia\Behavioral\Application;

use Gaia\Behavioral\GB;
use Gaia\Behavioral\Element;
use Gaia\Behavioral\Factory\ElementFactory;
// use Gaia\Behavioral\Factory\SimpleElementFactory;
// use Gaia\Behavioral\Factory\CompositeElementFactory;

/**
 * Singleton class that manage each and all behavioral elements.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
final class Repository
{
    private \ArrayObject $repo;
    
    private static $instance;
    
    private function __construct()
    {
        $this->repo = new \ArrayObject();
    }
    
    public static function getInstance()
    {
        if (! isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    /**
     * Returns element with the specified symbol.
     *
     * @return Element object or null
     * @param string $symbol
     */
    public function find(string $symbol) : ?Element
    {
        return $this->repo->offsetGet($symbol);
    }
    
    /**
     * Returns array of all items in this repo.
     *
     * @return array
     */
    public function itemsArray() : array
    {
        return $this->repo->getArrayCopy();
    }
    
    /**
     * Returns the number of all repo items.
     *
     * @return int
     */
    public function itemsCount() : int
    {
        return $this->repo->count();
    }
    
    /**
     * Tries to compose items from array and RESET the repository
     * bag with the result of successful parsing. If used with
     * with $strict, recomposition will only happen if, and only if,
     * ALL data items has been successfully parsed. When $strict is
     * false, recomposition ignores failed data items.
     *
     * @return int The number of items which has been successfully composed
     * @param array $data Items data
     * @param bool $strict
     */
    public function parseFromArray(array $data, bool $strict = false) : int
    {
        $validation = $this->check_data_integrity($data);
        if ($strict && $validation['integrity'] < 1) return 0;
        
        $count = 0;
        $data = $validation['data']; // All entries are now valid
        foreach ($data as $entry) { 
            $elm = ElementFactory::createElement($entry);
            
            foreach ($entry as $key => $val) {
                if (!in_array($key, GB::ELEMENT_IMMUTABLE_KEYS)) {
                    $elm->setProperty($key, $val);
                }
            }
            
            if ($count == 0) {
                $this->repo = new \ArrayObject();
                $this->repo->offsetSet($elm->getSymbol(), $elm);
                $count++;
            } else {
                // Only process unique element
                if (! $this->repo->offsetExists($elm->getSymbol())) {
                    $this->repo->offsetSet($elm->getSymbol(), $elm);
                    $count++;
                }
            }
        }
        return $count;
    }
    
    private function valid_entry($entry)
    {
        return $entry['name'] && $entry['symbol'] && $entry['definition'];
    }
    
    // Check wether each entry has required properties and
    // check they has unique symbol
    private function check_data_integrity(array $data) : array
    {
        $count = 0;
        $passed = 0;
        $validated = [];
        $symbols = [];
        
        foreach ($data as $entry) {
            $count++;
            if ($this->valid_entry($entry) && !in_array($entry['symbol'], $symbols)) {
                $passed++;
                $validated[] = $entry;
                $symbols[] = $entry['symbol'];
            }
        }
        
        return [
            'count' => $count,
            'validated' => $passed,
            'integrity' => $passed / $count,
            'data' => $validated
        ];
    }
} // END final class Repository
