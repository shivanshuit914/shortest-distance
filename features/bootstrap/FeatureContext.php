<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $users = [];

    private $path;

    /**
     * @Transform :user
     * @Transform :originUser
     * @Transform :destinationUser
     * @param string $name
     * @return User
     */
    public function makeUser(string $name)
    {
        return User::withName($name);
    }

    /**
     * @Given User :user has contributed to repositories :repositories
     */
    public function userHasContributedToRepositories(User $user, string $repositories)
    {
        $repositoriesObj = [];
        $repositories = explode(',', $repositories);
        foreach ($repositories as $repository) {
            $repositoriesObj[] = Repository::withName($repository);
        }
        $user->contributedTo($repositoriesObj);
        $this->users[] = $user;
    }

    /**
     * @When Client request for distance between user :originUser and user :destinationUser
     */
    public function clientRequestForDistanceBetweenUserAndUser(User $originUser, User $destinationUser)
    {
        $matrix = new MatrixGenerator();
        $matrix = $matrix->generate($this->users);
        $pathFinder = PathFinder::withMatrix($matrix);
        $this->path = $pathFinder->findDistancePath($originUser, $destinationUser);
    }

    /**
     * @Then System will response with  message :message
     */
    public function systemWillResponseWithMessage(string $message)
    {
        PHPUnit_Framework_TestCase::assertEquals($message , $this->path);
    }

}
