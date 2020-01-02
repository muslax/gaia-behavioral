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

use Gaia\Behavioral\GB;
use Gaia\Behavioral\Alias;

/**
 * Class that define Behavioral Element.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
abstract class Element implements Alias
{
    private string $name;
    
    private string $symbol;
    
    private string $definition;
    
    private string $description;
    
    private array $properties = [];
    
    private string $alias = '';
    
    private bool $useAlias = false;
    
    /**
     * Create new BehavioralElement.
     *
     * @param string $name The name of the element to be created
     * @param string $symbol The element's symbol
     * @param string $definition The element's definition
     * @param string $description The element's description
     */
    public function __construct(string $name, string $symbol, string $definition, string $description = '')
    {
        $this->name = $name;
        $this->symbol = $symbol;
        $this->definition = $definition;
        $this->description = $description;
    }
    
    /**
     * Returns the name of the element.
     * If alias has been set and useAlias is true,
     * it returns the alias instead.
     *
     * @return string
     */
    public function getName()
    {
        return $this->isAlias() && $this->useAlias ? $this->alias : $this->name;
    }
    
    /**
     * Returns the symbol of the element.
     *
     * @return string
     */
    public function getSymbol() : string
    {
        return $this->symbol;
    }
    
    /**
     * Returns the formal definition of the element.
     *
     * @return string
     */
    public function getDefinition() : string
    {
        return $this->definition;
    }
    
    /**
     * Returns the element's description.
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }
    
    /**
     * Returns array of all the element's properties.
     *
     * @return array
     */
    public function getProperties() : array
    {
        return array_merge($this->native_properties(), $this->properties);
    }
    
    /**
     * Set/change a property.
     *
     * @return BehavioralElement This element
     * @param string $key The property name to be set/changed
     * @param string $value The value of the new property
     *
     * @throws \Exception If the specified $key belongs to a protected property
     */
    public function setProperty(string $key, string $value) : BehavioralElement
    {
        if (in_array($key, GB::ELEMENT_IMMUTABLE_KEYS)) {
            throw new \OutOfBoundsException("Immutable property cannot be reassigned.");
        }
        
        $this->do_set_property($key, $value);
        return $this;
    }
    
    /**
     * Returns the alias of the element or null.
     * If alias has been set and useAlias is true,
     * it returns the name instead.
     *
     * @return string or null
     */
    public function getAlias() : ?string
    {
        // return $this->alias ? $this->alias : null;
        return $this->useAlias ? $this->name : $this->alias;
    }
    
    /**
     * Returns true if the element has an alias, otherwise false.
     *
     * @return bool
     */
    public function hasAlias() : bool
    {
        return $this->alias && $this->alias != '';
    }
    
    /**
     * If set to true, the element will use the alias as its name.
     *
     * @return void
     */
    public function useAlias(bool $use)
    {
        $this->useAlias = $use;
    }
    
    private function do_set_property($key, $value)
    {
        if ($key == 'description' || $key == 'alias') {
            $this->$key = $value;
        } else {
            $this->properties[$key] = $value;
        }
    }
    
    private function native_properties()
    {
        return [
            'name' => $this->name,
            'symbol' => $this->symbol,
            'definition' => $this->definition,
            'description' => $this->description,
            'alias' => $this->alias
        ];
    }
} // END abstract class Element
