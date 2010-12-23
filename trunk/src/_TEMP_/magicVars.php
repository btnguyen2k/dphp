<?php

class TestClass {

    public function __construct() {
        print_r(__CLASS__.'::'.__FUNCTION__);
        echo "\n";
    }

    public function abc() {
        //print_r(__CLASS__.'::'.__FUNCTION__);
        //echo "\n";
    }
}
$t = new TestClass();
$t->abc();

class TestClass2 extends TestClass {
    public function __construct() {
        print_r(__CLASS__.'::'.__FUNCTION__);
        echo "\n";
        parent::__construct();
    }

    public function def() {
        //print_r(__CLASS__.'::'.__FUNCTION__);
        //echo "\n";
    }
}
$t = new TestClass2();
$t->abc();
$t->def();
