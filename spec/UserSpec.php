<?php

namespace spec;

use Repository;
use User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWithName('A');
    }

    function it_exposes_name()
    {
        $this->getName()->shouldReturn('A');
    }

    function it_contributed_to_repositories_R1_R2()
    {
        $repositories = [Repository::withName('R1'), Repository::withName('R2')];
        $this->contributedTo($repositories);
    }

    function it_exposes_repository_contribution()
    {
        $repositories = [Repository::withName('R1'), Repository::withName('R2')];
        $this->contributedTo($repositories);
        $this->getContributedRepositories()->shouldReturn($repositories);
    }
}
