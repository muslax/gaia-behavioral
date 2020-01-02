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
 * Interface that composite element must implement.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
interface Composite
{
    /**
     * Adds an element as member.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return Composite
     * @param object $element
     */
    public function addMember(object $element) : Composite;
    
    /**
     * Remove element with specified symbol.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return object Removed element or null
     * @param string $symbol
     */
    public function removeMember(string $symbol) : ?object;
    
    /**
     * Returns array of all its members.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return array
     */
    public function allMembers() : array;
} // END interface Composite
