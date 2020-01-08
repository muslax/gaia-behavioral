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
 * Abstract class that provides general Workbook features.
 *
 * @author Arif Muslax <muslax@gmail.com>
 */
final class Workbook
{
    public static function validate(string $workbookURI, string $schemaURI) : bool
    {
        return false;
    }
    
    public static function validateAndPopulate(string $workbookURI, string $schemaURI, array &$propertyBag, array &$logs)
    {
        $reader = new \XMLReader();
        $reader->open($workbookURI);
        $reader->setRelaxNGSchema($schemaURI);
        libxml_use_internal_errors(TRUE);
        
        // $_logs_ = 0;
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
                    // $_logs_++;
                } else {
                     $compare = $logs[count($logs) -1];
                     // We only log different line numbers
                     if ($compare['line'] != $xmlError->line) {
                         $logs[] = [
                             'message' => trim($xmlError->message),
                             'file' => $xmlError->file,
                             'line' => $xmlError->line
                         ];
                         // $_logs_++;
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
            // if (! isset($propertyBag)) {
            //     $propertyBag = [];
            // }
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
            
            // return true;
            // DON'T KNOW WHY IT NEVER WORKS IF IT RETURN VALUE
        }
    }
    
    /**
     * TODO: LIKERT, OPTIONS, TEASER-TAIL
     */
    public static function createClientJSONWorkbook(string $workbookURI)
    {
        $workbook = [];
        $workbook['meta'] = [];
        $workbook['intro'] = '';
        $workbook['sections'] = [];
        
        $reader = new \XMLReader();
        $reader->open($workbookURI);
        
        $depth1 = '';
        $depth2 = '';
        $depth3 = '';
        $depth4 = '';
        $depth5 = '';
        $sections = -1;
        $sectionItems = -1;
        
        while ($reader->read()) {
            switch ($reader->depth) {
                case 1: $depth1 = $reader->localName; break;
                case 2: $depth2 = $reader->localName; break;
                case 3: $depth3 = $reader->localName; break;
                case 4: $depth4 = $reader->localName; break;
                case 5: $depth5 = $reader->localName; break;
            }
            
            // Meta
            if ($depth1 == 'META' && $reader->nodeType == \XMLREADER::ELEMENT) {
                if ($reader->getAttribute('value') !== null) {
                    $workbook['meta'][$reader->localName] = $reader->getAttribute('value');
                }
                if ($depth2 == 'likert' && $depth3 == 'Option') {
                    if (! isset($workbook['meta']['likert'])) $workbook['meta']['likert'] = [];
                    $seq = count($workbook['meta']['likert']) +1;
                    $workbook['meta']['likert'][] = [
                        'seq' => $seq,
                        'value' => $reader->readString()
                    ];
                }
            }
            
            // Intro
            else if ($depth1 == 'BookIntro' && $reader->nodeType == \XMLREADER::ELEMENT) {
                $lines = explode("\n", $reader->readString());
                foreach ($lines as $line) {
                    $workbook['intro'] .= trim($line);
                }
            }
            
            // Sections
            else if ($depth2 == 'Section' && $reader->localName == 'Section' && $reader->nodeType == \XMLREADER::ELEMENT) {
                $workbook['sections'][] = ['article' => null, 'test-items' => []];
                $sections++;
                $sectionItems = -1;
            }
            
            // Article
            else if ($depth3 == 'Article' && $reader->localName == 'Article' && $reader->nodeType == \XMLREADER::ELEMENT) {
                $lines = explode("\n", $reader->readString());
                $workbook['sections'][$sections]['article'] = '';
                foreach ($lines as $line) {
                   $workbook['sections'][$sections]['article'] .= trim($line);
                }
            }
            
            // TestItem
            else if ($depth3 == 'TestItem' && $reader->localName == 'TestItem' && $reader->nodeType == \XMLREADER::ELEMENT) {
                $workbook['sections'][$sections]['test-items'][] = ['teaser' => null, 'options' => '@likert']; 
                $sectionItems++;
            }
            
            // Teaser
            else if ($depth4 == 'Teaser' && $reader->localName == 'Teaser' && $reader->nodeType == \XMLREADER::ELEMENT) {
                $workbook['sections'][$sections]['test-items'][$sectionItems]['teaser'] = $reader->readString();
            }
            
            // Options
        }
        
        return json_encode($workbook);
    }
    
    public static function transform() : string
    {
        return '';
    }
} // END class Workbook
