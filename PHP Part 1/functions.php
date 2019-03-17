<?php // declare(strict_types=1);
    // This is GLOBAL scope and we CAN'T use the variable $students INSIDE functions
    $students = ['Ivan', 'Maria']; 

    function add($a, $b) {
        return $a + $b;
    }

    function increment() {
        // We use the key word static to preserve the state of the variable
        // This is LOCAL scope and we CAN'T use the variable $a OUTSIDE the function
        static $a = 0;

        echo $a . "<br/>";

        ++$a;
    }

    // function with default parameter
    function greet($name = 'George') {
        return "Hello, $name!";
    }

    function addStudent($student) {
        // local scope
        // To use variables from the global scope we use the key word global
        global $students;
        $students[] = $student;

        // <=> $GLOBALS['students'][] = $student;
    }

    echo add(1, 2) . "<br/>"; // 3
    echo add(3, '5a') . "<br/>"; // PHP is loosely typed, so '5a' is converted to 5 and the result is 8

    increment(); // 0
    increment(); // 1
    increment(); // 2

    echo greet('Lili') . "<br/>"; // Hello, Lili!
    echo greet() . "<br/>"; // Hello, George!
    echo greet(null) . "<br/>"; // Hello, !

    addStudent('Dragan');
    print_r($students); // Array ( [0] => Ivan [1] => Maria [2] => Dragan )
?>