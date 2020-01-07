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

use \XMLReader;

/**
 * Abstract class that provides general WorkBook features.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
final class WorkBook
{
    public static function validate(string $URI, string $rngSchema, array &$propertyBag, array &$logs)
    {
        $reader = new \XMLReader();
        $reader->open($URI);
        $reader->setRelaxNGSchema($rngSchema);
        libxml_use_internal_errors(TRUE);
        
        $depth1 = '';
        $depth2 = '';
        $depth3 = '';
        $depth4 = '';
        $depth5 = '';
        
        while ($reader->read()) {
            // If not valid, collect log
            if (! $reader->isValid()) {
                $xmlError = libxml_get_last_error();
                if (count($logs) == 0) {
                    $logs[] = [
                        'message' => trim($xmlError->message),
                        'file' => $xmlError->file,
                        'line' => $xmlError->line
                    ];
                } else {
                     $compare = $logs[count($logs) -1];
                     // We only log different line numbers
                     if ($compare['line'] != $xmlError->line) {
                         $logs[] = [
                             'message' => trim($xmlError->message),
                             'file' => $xmlError->file,
                             'line' => $xmlError->line
                         ];
                     }
                }
            }
            
            switch ($reader->depth) {
                case 1: $depth1 = $reader->localName; break;
                case 2: $depth2 = $reader->localName; break;
                case 3: $depth3 = $reader->localName; break;
                case 4: $depth4 = $reader->localName; break;
                case 5: $depth5 = $reader->localName; break;
            }
            
            // META
            if ($depth1 == 'META' && $reader->nodeType == \XMLREADER::ELEMENT) {
                if ($reader->getAttribute('value') !== null) {
                    if (! isset($propertyBag['META'])) $propertyBag['META'] = [];
                    $propertyBag['META'][$reader->localName] = $reader->getAttribute('value');
                }
                if ($depth2 == 'likert' && $depth3 == 'Option') {
                    if (! isset($propertyBag['META']['likert'])) $propertyBag['META']['likert'] = [];
                    $seq = count($propertyBag['META']['likert']) +1;
                    $propertyBag['META']['likert'][] = [
                        'seq' => $seq,
                        'value' => $reader->readString()
                    ];
                }
            }
            
            // INTRO
            if ($depth1 == 'BookIntro' && $reader->nodeType == \XMLREADER::ELEMENT) {
                $propertyBag['Intro'] = htmlspecialchars($reader->readString());
            }
            
            // TODO BOOLBODY
            
            // TODO EPILOG
        }
    }
} // END class WorkBook
