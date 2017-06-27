<?php

class PathFinder
{
    /**
     * @var array
     */
    private $matrix;

    private $visited = [];

    private function __construct(array $matrix)
    {
        $this->matrix = $matrix;
    }

    public static function withMatrix(array $matrix)
    {
        return new static($matrix);
    }

    /**
     * @param User $originUser
     * @param User $destinationUser
     * @return string
     */
    public function findDistancePath(User $originUser, User $destinationUser) : string
    {
        $originUser = $originUser->getName();
        $destinationUser = $destinationUser->getName();
        // mark all nodes as unvisited
        foreach ($this->matrix as $vertex => $adj) {
            $this->visited[$vertex] = false;
        }

        // create an empty queue
        $queue = new SplQueue();
        $queue->enqueue($originUser);
        $this->visited[$originUser] = true;

        // path to track visited vertices
        $path = [];
        $path[$originUser] = new SplDoublyLinkedList();
        $path[$originUser]->setIteratorMode(
            SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP
        );

        $path[$originUser]->push($originUser);
        $path = $this->enqueAndVisitVertices($queue, $path, $destinationUser);
        return $this->generatePath($originUser, $destinationUser, $path);
    }

    /**
     * @param SplQueue $queue
     * @param array $path
     * @param $destinationUser
     * @return array
     */
    private function enqueAndVisitVertices(SplQueue $queue, array $path, $destinationUser) : array
    {
        while (!$queue->isEmpty() && $queue->bottom() != $destinationUser) {
            $top = $queue->dequeue();

            if (!empty($this->matrix[$top])) {
                foreach ($this->matrix[$top] as $vertex) {
                    if (!$this->visited[$vertex]) {
                        $queue->enqueue($vertex);
                        $this->visited[$vertex] = true;
                        $path[$vertex] = clone $path[$top];
                        $path[$vertex]->push($vertex);
                    }
                }
            }
        }

        return $path;
    }


    /**
     * @param string $originUser
     * @param string $destinationUser
     * @param array   $path
     * @return string
     */
    private function generatePath(string  $originUser,string $destinationUser, array $path) : string
    {
        $distancePath = 'Path not found between ' . $originUser . ' and ' . $destinationUser;
        if (!isset($path[$destinationUser])) {
            return $distancePath;
        }

        $distancePath = 'Shortest distance path between ' . $originUser . ' and ' . $destinationUser . ' is ';

        foreach ($path[$destinationUser] as $vertex) {
            $distancePath .= $vertex;
            if ($vertex !== $destinationUser) {
                $distancePath .= ' -> ';
            }
        }

        return $distancePath;
    }
}
