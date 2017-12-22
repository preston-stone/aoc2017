<?php
/**
 * Basic PHP class to solve Advent of Code 2017 Day 3.
 * https://adventofcode.com/2017/day/3
 * 
 * To find the solution for part 2, consult this link: https://oeis.org/A141481
 * 
 */

class pathFinder{

    // Number to work with
    public $num;

    // Row in which $num lives (relative to position of 1)
    public $row;

    // Length of the row
    public $length;

    // Starting number for the row
    public $startNum;

    // Ending number for the row
    public $endNum;

    // Column position of $num
    public $col;

    // Column position of $num, relative to the column position of 1
    public $homeLocation;

    // The number of moves required to get from $num to 1
    public $stepsHome;

    public function __construct($num){
        $this->num = $num;

        $this->findRow();
        $this->findLength();
        $this->findEnd();
        $this->findStart();
        $this->findCol();
        $this->findHome();
        $this->taxicab();
    }

    /**
     * Each row's penultimate number is the square of an odd number. The formula for finding that square is:
     * (2r+1)^2
     * 
     * Where r is the row number relative to the position of 1. To get the final number in the row, add 1 to the above.
     * findRow() reverse engineers that equation. 
     *
     *
     */
    private function findRow(){
        $this->row = (ceil(sqrt($this->num)) - 1) / 2;
    }

    /**
     * Length of each row is the row number+1*2 
     * 
     */
    private function findLength(){
        $this->length = ($this->row + 1) * 2;
    }

    /**
     * Last element in each row is the square of an odd number + 1
     */
    private function findEnd(){
        $factor = $this->row * 2 + 1;
        $this->endNum = pow($factor,2)+1;
    }

    /**
     * First element of each row is the end element - row length +1
     */
    private function findStart(){
        $this->startNum = $this->endNum - $this->length + 1;
    }

    /**
     * Number's column position is the number - starting element + 1
     */
    private function findCol(){
        $this->col = $this->num - $this->startNum + 1;
    }

    /**
     * Find the column (y) position of 1, relative to the target number, by calculating |number y position - (row length / 2)|
     */
    private function findHome(){
        $this->homeLocation = abs($this->col - ($this->length / 2 ));
    }

    /**
     * Taxicab function. To calculate the taxicab geometry of two numbers, you need the x/y positions of both (x1 and y1 
     * for the first number, and x2, y2 for the second number). The formula is simple:
     * d = | (x2 - x1) + (y2 - y1) |
     * Since the relative position of the first number, 1, in our matrix is 0,0, the formula is simply x2+y2.
     */
    private function taxicab(){
        $this->stepsHome = $this->homeLocation + $this->row;
    }
}

$f = new pathFinder(277678);
echo "Row: " . $f->row . "<br>";
echo "Col: " . $f->col . "<br>";
echo "Row start: " . $f->startNum . "<br>";
echo "Row end: " . $f->endNum . "<br>";
echo "Row length: " . $f->length . "<br>";
echo "Position relative to home: " . $f->homeLocation . "<br>";

echo "Steps home: " . $f->stepsHome;

?>