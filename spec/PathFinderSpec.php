<?php

namespace spec;

use PathFinder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use User;

class PathFinderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWithMatrix(['A' => ['R1', 'R2'], 'R1' => ['A'], 'R2' => ['A', 'B'], 'B' => ['R2', 'R3'], 'R3' => ['B']]);
    }

    function it_finds_shortest_path_between_two_contributors()
    {
        $result = 'Shortest distance path between A and B is A -> R2 -> B';
        $this->findDistancePath(User::withName('A'), User::withName('B'))->shouldReturn($result);
    }
}
