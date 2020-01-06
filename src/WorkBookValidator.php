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
 * Class that validate WorkBooks.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
class WorkBookValidator
{
    public static string $relaxNGFile;
    
    public static bool validate($dom)
    {
        if (! isset(self::$relaxNGFile)) {
            throw new \Exception('RelaxNG Schema has not been set.');
        }
        
        // TODO Write validation code
        return true;
    }
} // END class WorkBookValidator