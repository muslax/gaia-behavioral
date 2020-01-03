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

use Gaia\Behavioral\Application\SimpleElement;

/**
 * Class that is responsible to creating SimpleElement objects.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
class SimpleElementFactory extends ElementFactory
{
    public function createElement($properties) : SimpleElement
    {
        $properties['description'] ??= '';
        
        if (!$properties['name'] || !$properties['symbol'] || !$properties['definition']) {
            throw new \Exception("Either name, symbol or definition is/are invalid.");
        }
        
        return new SimpleElement(
            $properties['name'],
            $properties['symbol'],
            $properties['definition'],
            $properties['description']
        );
    }
} // END class SimpleElementFactory extends ElementFactory
