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
 * Interface that Evidence class must implement.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
interface Evidence
{
    /**
     * Returns evidence data.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return array
     */
    public function getData() : array;
    
    /**
     * Returns evidence owner.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return void
     * @param what
     */
    public function getOwner() : Assessee;
} // END interface Evidence