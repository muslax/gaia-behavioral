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

use Gaia\Behavioral\Element;
use Gaia\Behavioral\Evidence;
use Gaia\Behavioral\Workbook;

/**
 * Class that define Behavioral Module.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
abstract class Module
{
    private Workbook $book;
    
    private array $elements;
    
    /**
     * Generate elements' score given the evidence.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return array
     * @param Evidence
     */
    public abstract function score(Evidence $evidence) : array;
    
    /**
     * Generate Workbook object with options.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return object
     * @param mixed
     */
    public abstract function generateWorkbook(Evidence $evidence, mixed ...$options) : ?object;
    
    /**
     * Generates report.
     *
     * @author Arif Muslax <muslax@gmail.com>
     *
     * @return void
     * @param what
     */
    public abstract function generateReport(Evidence $evidence, mixed ...$options) : ?object;
} // END abstract class Module
