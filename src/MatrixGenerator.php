<?php

class MatrixGenerator
{
    public function generate(array $users)
    {
        $matrix = [];
        foreach ($users as $user) {
            $repos = function () use ($user) {

                $repos = [];
                foreach ($user->getContributedRepositories() as $repository) {
                    $repos[] = $repository->getName();
                }

                return $repos;
            };
            $matrix[$user->getName()] = $repos();

            foreach ($repos() as $repo) {
                $matrix[$repo][] = $user->getName();
            }
        }

        return $matrix;
    }
}
