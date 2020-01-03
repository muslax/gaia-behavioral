<?php

namespace Gaia\Behavioral\Samples;

use Gaia\Behavioral\Evidence;
use Gaia\Behavioral\Assessee;

class SimpleEvidence implements Evidence
{
    private array $data;
    
    private User $owner;
    
    public function __construct(Assessee $user, array $data)
    {
        $this->owner = $user;
        $this->data = $data;
    }
    
    public function getData() : array
    {
        return $this->data;
    }
    
    public function getOwner() : User
    {
        return $this->owner;
    }
}
