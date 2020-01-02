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
 * Interface that provides alternate name.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
interface Alias
{
    /**
     * Return the alias.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return string or null
     */
    public function getAlias() : ?string;
    
    /**
     * Returns wether an alias has been set.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return bool
     */
    public function hasAlias() : bool;
    
    /**
     * Set to use or not to use alias.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return void
     * @param what
     */
    public function useAlias(bool $use);
} // END interface Alias