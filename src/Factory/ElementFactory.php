<?php

/**
 * This file is part of the Gaia Behavioral package.
 *
 * @author Arif Muslax <muslax@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gaia\Behavioral\Factory;

use Gaia\Behavioral\Element;

/**
 * Abstract factory for creating element.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
abstract class ElementFactory
{
    /**
     * Create concrete element object with specified properties
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return Element object
     * @param mixed $properties
     */
    protected abstract function createElement(mixed $properties) : Element;
} // END abstract class ElementFactory
