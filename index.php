<?php
class Graph
{
    protected $graph;
    protected $visited = array();

    public function __construct($graph) {
        $this->graph = $graph;
    }

    // find least number of hops (edges) between 2 nodes
    // (vertices)
    public function breadthFirstSearch($origin, $destination) {
        // mark all nodes as unvisited
        foreach ($this->graph as $vertex => $adj) {
            $this->visited[$vertex] = false;
        }

        // create an empty queue
        $q = new SplQueue();

        // enqueue the origin vertex and mark as visited
        $q->enqueue($origin);
        $this->visited[$origin] = true;

        // this is used to track the path back from each node
        $path = array();
        $path[$origin] = new SplDoublyLinkedList();
        $path[$origin]->setIteratorMode(
            SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP
        );

        $path[$origin]->push($origin);

        $found = false;
        // while queue is not empty and destination not found
        while (!$q->isEmpty() && $q->bottom() != $destination) {
            $t = $q->dequeue();

            if (!empty($this->graph[$t])) {
                print_r($this->graph[$t]);
                // for each adjacent neighbor
                foreach ($this->graph[$t] as $vertex) {
                    if (!$this->visited[$vertex]) {
                        // if not yet visited, enqueue vertex and mark
                        // as visited
                        $q->enqueue($vertex);
                        $this->visited[$vertex] = true;
                        // add vertex to current path
                        $path[$vertex] = clone $path[$t];
                        $path[$vertex]->push($vertex);
                    }
                }
            }
        }

        if (isset($path[$destination])) {
            echo "$origin to $destination in ",
                count($path[$destination]) - 1,
            " hopsn";
            $sep = '';
            foreach ($path[$destination] as $vertex) {
                echo $sep, $vertex;
                $sep = '->';
            }
            echo "n";
        }
        else {
            echo "No route from $origin to $destination";
        }
    }
}


$graph = array(
    'A' => array('R1', 'R2', 'R3', 'R5'),
    'B' => array('R2', 'R3'),
    'C' => array('R4', 'R5'),
    'R1' => array('A'),
    'R2' => array('A', 'B'),
    'R3' => array('A', 'B', 'C'),
    'R4' => array('C'),
    'R5' => array('A', 'C'),
);

$g = new Graph($graph);

// least number of hops between D and C
$g->breadthFirstSearch('A', 'B');
