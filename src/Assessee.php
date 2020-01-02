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
 * Interface that all assessees must implement.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
interface Assessee
{
    /**
     * Returns the id of the Assessee.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return string
     */
    public function getId() : string;
    
    /**
     * Returns the name of the Assessee.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return void
     * @param what
     */
    public function getName() : string;
} // END interface Assessee