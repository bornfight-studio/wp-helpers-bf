<?php

namespace bornfight\wpHelpers\cli\attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Attr
{
    public string $command;
    public string $shortdesc;

    public function __construct( string $command, string $shortdesc = '' )
    {
        $this->command   = $command;
        $this->shortdesc = $shortdesc;
    }
}
