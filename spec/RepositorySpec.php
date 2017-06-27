<?php

namespace spec;

use Repository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWithName('R1');
    }

    function it_exposes_name()
    {
        $this->getName()->shouldReturn('R1');
    }
}
