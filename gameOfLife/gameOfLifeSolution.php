<?php

class NewGame
{
    public $xsize;
    public $ysize;
    public $grid = [];

    /**
     * NewGame constructor.
     * @param $xsize int of cells in horizontal axis
     * @param $ysize int of cells in vertical axis
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

    /**
     * displays the grid based on given array
     *
     * @param $gridArr array containing the grid info
     */
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

    /**
     * calculates the next generation
     */
    public function nextGeneration()
    {
        $highestDesig = ($this->xsize * $this->ysize) -1;

        $newGrid = [];

        for ($i = 0; $i <= $highestDesig; $i++) {

            $cell = $this->grid[$i];

            $designation = $cell->designation;

            $state = 0;

            //top left corner
            if ($designation == 0) {
                $state += $this->grid[(int)$designation + 1]->state;
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                $state += $this->grid[(int)$designation + $this->xsize + 1]->state;

                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));


            }
            //top right
            elseif ($designation == $this->xsize -1) {
                $state += $this->grid[(int)$designation - 1]->state;
                $state += $this->grid[(int)$designation + $this->xsize - 1]->state;
                $state += $this->grid[(int)$designation + $this->xsize]->state;

                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //bottom right
            elseif ($designation == $highestDesig) {
                $state += $this->grid[(int)$designation - $this->xsize - 1]->state;
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                $state += $this->grid[(int)$designation - 1]->state;

                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //bottom left
            elseif ($designation == ($highestDesig - $this->xsize +1)) {
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                $state += $this->grid[(int)$designation - $this->xsize + 1]->state;
                $state += $this->grid[(int)$designation + 1]->state;

                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //top middle
            elseif ($designation > 0 && $designation < $this->xsize-1) {
                $state += $this->grid[(int)$designation - 1]->state;
                $state += $this->grid[(int)$designation + 1]->state;
                $state += $this->grid[(int)$designation + $this->xsize -1]->state;
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                $state += $this->grid[(int)$designation + $this->xsize +1]->state;

                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //right middle
            elseif ($designation != $this->xsize && $designation != $highestDesig && ((($designation + 1) % $this->xsize) == 0)) {
                $state += $this->grid[(int)$designation - $this->xsize -1]->state;
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                $state += $this->grid[(int)$designation - 1]->state;
                $state += $this->grid[(int)$designation + $this->xsize -1]->state;
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            //bottom middle
            elseif ($designation > ($highestDesig - $this->xsize +1) && $designation < $highestDesig) {
                $state += $this->grid[(int)$designation - 1]->state;
                $state += $this->grid[(int)$designation - $this->xsize -1]->state;
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                $state += $this->grid[(int)$designation - $this->xsize +1]->state;
                $state += $this->grid[(int)$designation + 1]->state;

                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            // left middle
            elseif ($designation != ($highestDesig - $this->xsize +1) && ($designation % $this->xsize) == 0) {
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                $state += $this->grid[(int)$designation - $this->xsize +1]->state;
                $state += $this->grid[(int)$designation + 1]->state;
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                $state += $this->grid[(int)$designation + $this->xsize + 1]->state;
                $assessedState = $this->assessState($cell, $state);
                array_push($newGrid, new Cell($assessedState,$i));
            }

            else {
                $state += $this->grid[(int)$designation - $this->xsize -1]->state;
                $state += $this->grid[(int)$designation - $this->xsize]->state;
                $state += $this->grid[(int)$designation - $this->xsize +1]->state;
                $state += $this->grid[(int)$designation - 1]->state;
                $state += $this->grid[(int)$designation + 1]->state;
                $state += $this->grid[(int)$designation + $this->xsize -1]->state;
                $state += $this->grid[(int)$designation + $this->xsize]->state;
                $state += $this->grid[(int)$designation + $this->xsize + 1]->state;

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
     * @param $state int the state of that cell
     * @return int 0 dead, 1 live
     */
    private function assessState($cell, $state)
    {
        if ($cell->state == 0) {

            if ($state == 3) {
                return 1;
            } else {
                return 0;
            }

        } else {

            if ($state == 2 || $state == 3) {
                return 1;

            } else {

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
     * @param $state int alive = 1, dead = 0
     * @param $designation int position in grid
     */
    public function __construct(int $state, int $designation)
    {
        $this->state = $state;
        $this->designation = $designation;
    }
}

$game1 = new NewGame(8,4);

$game1->grid[12]->state = 1;
$game1->grid[19]->state = 1;
$game1->grid[20]->state = 1;
//$game1->grid[4]->state = 1;
//$game1->grid[5]->state = 1;
//$game1->grid[8]->state = 1;
//$game1->grid[9]->state = 1;
//$game1->grid[10]->state = 1;
//$game1->grid[11]->state = 1;
//$game1->grid[12]->state = 1;
$game1->showGame($game1->grid);
$game1->nextGeneration();
