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

use Gaia\Behavioral\Element;
use Gaia\Behavioral\Composite;

/**
 * Class that does the deeds.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
class CompositeElement extends Element implements Composite
{
    private array $members = [];
        
    public function addMember(object $elm) : CompositeElement
    {
        $this->do_add_member($elm);
        return $this;
    }
    
    public function removeMember(string $symbol) : ?Element
    {
        if (isset($this->members[$symbol])) {
            $removed = $this->members[$symbol];
            unset($this->members[$symbol]);
            return $removed;
        }
        return null;
    }
    
    public function allMembers() : array
    {
        return $this->members;
    }
    
    public function numMembers() : int
    {
        return count($this->members);
    }
    
    private function do_add_member($elm)
    {
        if (! $elm instanceof Element) {
            throw new \TypeError("The argument \$elm must be of Element type.");
        }
        if ($elm->getSymbol() == $this->getSymbol()) {
            $symbol = $this->getSymbol();
            throw new \CompileError("Cannot add member that uses the same symbol ($symbol) of the container.");
        }
        if (! empty($this->members[$elm->getSymbol()])) {
            $symbol = $elm->getSymbol();
            throw new \OverflowException("Element with symbol $symbol already exists.");
        }
        
        $this->members[$elm->getSymbol()] = $elm;
    }
} // END class CompositeElement extends Element implements Composite