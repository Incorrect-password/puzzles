<?php

class NewGame
{
    public $xsize;
    public $ysize;
    public $grid = [];

    /**
     * NewGame constructor.
     * @param $xsize cells in horizontal axis
     * @param $ysize cells in vertical axis
     */
    public function __construct($xsize, $ysize)
    {
        $this->xsize = $xsize;
        $this->ysize = $ysize;

        //calculate grid size
        $gridSize = ($this->xsize * $this->ysize);
        //generate grid array
        for ($i = 0; $i < $gridSize; $i++) {

            array_push($this->grid, new Cell(0,$i));
        }
    }

    public function showGame($gridArr){
        foreach ($gridArr as $cell) {
            if ((($cell->designation +1) % $this->xsize) == 0) {
                if ($cell->state == 1) {
                    echo '*';
                } else if ($cell->state == 0) {
                    echo '. ';
                }
                echo '<br>';
            } else {
                if ($cell->state == 1) {
                    echo '*';
                } else if ($cell->state == 0) {
                    echo '. ';
                }
            }
        }
        echo '<br>';
    }

//    public function getCellState(int $cellPosition)
//    {
//        //add top invisi line
//        $cellID = $cellPosition + $this->xsize;
//        //calculate how many rows down
//        $extra = floor($cellID / $this->xsize);
//        var_dump($extra);
//        var_dump($cellID);
//        //add extra invisi as
//        $cellID += $extra * 2;
//        var_dump($cellID);
//        echo $this->grid[$cellID]->state;
//    }
    public function setCellState(){}

    public function nextGeneration()
    {
        $highestDesig = ($this->xsize * $this->ysize) -1;

        $newGrid = [];

        for ($i = 0; $i <= $highestDesig; $i++) {
//            echo $i;
            $cell = $this->grid[$i];

            $designation = $cell->designation;
            echo  '<br>';
            echo $designation . '<br>';
            $state = 0;

            //top left corner
            if ($designation == 0) {
                $state += $this->grid[(int)$designation + 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize + 1]->state;
                echo $state . ' ';
                echo 'top left';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));


            }
            //top right
            elseif ($designation == $this->xsize -1) {
                $state += $this->grid[(int)$designation - 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize - 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                echo $state . ' ';
                echo 'top right';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //bottom right
            elseif ($designation == $highestDesig) {
                $state += $this->grid[(int)$designation - $this->xsize - 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - 1]->state;
                echo $state . ' ';
                echo 'bot right';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //bottom left
            elseif ($designation == ($highestDesig - $this->xsize +1)) {
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize + 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + 1]->state;
                echo $state . ' ';
                echo 'bot left';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //top middle
            elseif ($designation > 0 && $designation < $this->xsize-1) {
                $state += $this->grid[(int)$designation - 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize -1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize +1]->state;
                echo $state . ' ';
                echo 'top mid';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //right middle
            elseif ($designation != $this->xsize && $designation != $highestDesig && ((($designation + 1) % $this->xsize) == 0)) {
                $state += $this->grid[(int)$designation - $this->xsize -1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize -1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                echo $state . ' ';
                echo 'right mid';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //bottom middle
            elseif ($designation > ($highestDesig - $this->xsize +1) && $designation < $highestDesig) {
                $state += $this->grid[(int)$designation - 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize -1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize +1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + 1]->state;
                echo $state . ' ';
                echo 'bot mid';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            // left middle
            elseif ($designation != ($highestDesig - $this->xsize +1) && ($designation % $this->xsize) == 0) {
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize +1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize + 1]->state;
                echo $state . ' ';
                echo 'left mid';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            else {
                $state += $this->grid[(int)$designation - $this->xsize -1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - $this->xsize +1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation - 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + 1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize -1]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                echo $state . ' ';
                $state += $this->grid[(int)$designation + $this->xsize + 1]->state;
                echo $state . ' ';
                echo 'mid';
                echo '<br>';
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }
        }
        $this->showGame($newGrid);
    }

    /**
     * assess whether a cell should live, die or come back to life and adds it to a new arr
     *
     * @param $cell cell being assessed
     * @param $state the state of that cell
     * @return int 0 dead, 1 live
     */
    private function assessState($cell, $state)
    {
        if ($cell->state == 0) {

            if ($state == 3) {
                echo 'revived<br>';
                return 1;
            } else {
                echo 'deadaf<br>';
                return 0;
            }

        } else {

            if ($state == 2 || $state == 3) {
                echo 'live<br> ';
                return 1;

            } else {

                echo 'die<br> ';
                return 0;

            }
        }
    }
}

class Cell {
    public $state;
    public $designation;

    /**
     * Cell constructor.
     * @param $state alive = 1, dead = -1, null = 0
     * @param $designation position in grid
     */
    public function __construct(int $state, int $designation)
    {
        $this->state = $state;
        $this->designation = $designation;
    }

    public function getCellState(){}
    public function setCellState(){}
}

$game1 = new NewGame(8,4);

$game1->grid[1]->state = 1;
$game1->grid[2]->state = 1;
$game1->grid[3]->state = 1;
$game1->grid[4]->state = 1;
$game1->grid[5]->state = 1;
//$game1->grid[8]->state = 1;
//$game1->grid[9]->state = 1;
//$game1->grid[10]->state = 1;
//$game1->grid[11]->state = 1;
//$game1->grid[12]->state = 1;
$game1->showGame($game1->grid);
$game1->nextGeneration();


