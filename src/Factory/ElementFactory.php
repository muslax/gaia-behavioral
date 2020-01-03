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
use Gaia\Behavioral\Application\SimpleElement;
use Gaia\Behavioral\Application\CompositeElement;

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
    public static function createElement($properties) : Element
    {
        $properties['description'] ??= '';
        
        if (isset($properties['composite']) && $properties['composite']) {
            return new CompositeElement(
                $properties['name'],
                $properties['symbol'],
                $properties['definition'],
                $properties['description']
            );
        }
        
        return new SimpleElement(
            $properties['name'],
            $properties['symbol'],
            $properties['definition'],
            $properties['description']
        );
    }
} // END abstract class ElementFactory
