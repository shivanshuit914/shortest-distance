<?php

namespace spec;

use MatrixGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Repository;
use User;

class MatrixGeneratorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith();
    }

    function it_generates_relation_mattrix_for_users_by_repository_contributions()
    {
        $repositories = [Repository::withName('R1'), Repository::withName('R2')];
        $user1 = User::withName('A');
        $user1->contributedTo($repositories);

        $repositories2 = [Repository::withName('R2'), Repository::withName('R3')];
        $user2 = User::withName('B');
        $user2->contributedTo($repositories2);

        $resultMatrix = ['A' => ['R1', 'R2'], 'R1' => ['A'], 'R2' => ['A', 'B'], 'B' => ['R2', 'R3'], 'R3' => ['B']];
        $this->generate([$user1, $user2])->shouldReturn($resultMatrix);
    }
}
