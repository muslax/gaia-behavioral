<?php

namespace Gaia\Behavioral\Samples;

use Gaia\Behavioral\Module;
use Gaia\Behavioral\Evidence;

class SimpleModule extends Module    
{
    public function score(Evidence $evidence) : array
    {
        return ['SCORE' => 'TEST'];
    }
    
    public function generateReport(Evidence $evidence, array $options = []) : ?object
    {
        return null;
    }
}
