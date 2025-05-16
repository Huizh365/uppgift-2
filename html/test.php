<?php
    $test_array = [1, 2, 3];

    /* 1. anonymous function
    $test_array = array_map(function($item) {
        return $item + 2;
    }, $test_array);
    */
    $sum_to_add = 2;

    /* 2. call function in array_map, while using function name as a string
    function fsu24d_add_to_array($item) {
        global $sum_to_add;
        return $item + $sum_to_add;
    }

    $test_array = array_map("fsu24d_add_to_array", $test_array);
    */

    /* 3. create an Object with function
    class TestObject {
        public function add_to_array($item) {
        global $sum_to_add;
        return $item + $sum_to_add;
        }
    }
    $object = new TestObject();
    $test_array = array_map([$object, "add_to_array"], $test_array);
    */ 

    /* 4. static function,  use CLASS directly */
    class TestObject {
        public static function add_to_array($item) {
        global $sum_to_add;
        return $item + $sum_to_add;
        }
    }
    $test_array = array_map("TestObject::add_to_array", $test_array); 
    // use :: to call a static function in a class

    var_dump($test_array); 
?>