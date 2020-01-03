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
 * Class that provides constants to use.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
final class GB
{
    /** Immutable keys for BehavioralElement */
    const ELEMENT_IMMUTABLE_KEYS = ['name', 'symbol', 'definition'];
    
    /** Reserved keys for BehavioralElement */
    const ELEMENT_RESERVED_KEYS  = ['description', 'alias'];
    
    /** GB */
    const GB_EVIDENCE_OPTION     = 'Option';
    
    /** GB */
    const GB_EVIDENCE_WRITING    = 'Writing';
    
    /** GB */
    const GB_EVIDENCE_BEHAVIOR   = 'Behavior';
    
    /** GB */
    const GB_OPTIONS_LIKERT      = 'Likert';
    
    /** GB */
    const GB_OPTIONS_STATEMENT   = 'Statement';
    
    /** GB */
    const GB_OPTIONS_NUMS_2      = 2;
    
    /** GB */
    const GB_OPTIONS_NUMS_3      = 3;
    
    /** GB */
    const GB_OPTIONS_NUMS_4      = 4;
    
    /** GB */
    const GB_OPTIONS_NUMS_5      = 5;
    
    /** GB */
    const GB_OPTIONS_SELECT_1    = 1;
    
    /** GB */
    const GB_OPTIONS_SELECT_2    = 2;
    
    /** GB */
    const GB_MODULE_AIME_FORMAL  = "AIME Formal Name";
    
    /** GB */
    const GB_MODULE_AIME_SHORT   = "G-AIME";
} // END final class GB
