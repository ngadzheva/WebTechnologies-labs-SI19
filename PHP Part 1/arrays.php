<?php
    // Create an indexed array
    $students = ['Ivan', 'Petkan', 'Maria']; // <=> $students = array(Ivan', 'Petkan', 'Maria')
    
    // Print the array
    var_dump($students); // array(3) { [0]=> string(4) "Ivan" [1]=> string(6) "Petkan" [2]=> string(5) "Maria" }
    echo '<br/>';
    print_r($students); // Array ( [0] => Ivan [1] => Petkan [2] => Maria )
    echo '<br/>';

    // Delete the last element from the array
    array_pop($students);
    print_r($students); // Array ( [0] => Ivan [1] => Petkan )
    echo '<br/>';

    // Delete the first element from the array
    array_shift($students);
    print_r($students); // Array ( [0] => Petkan )
    echo '<br/>';

    // Add an element to the end of the array
    array_push($students, 'Ivan');
    print_r($students); // Array ( [0] => Petkan [1] => Ivan )
    echo '<br/>';

    $students[] = 'Dragan';
    print_r($students); // Array ( [0] => Petkan [1] => Ivan [2] => Dragan )
    echo '<br/>';

    // Add an element to the beginning of the array
    array_unshift($students, 'Maria');
    print_r($students); // Array ( [0] => Maria [1] => Petkan [2] => Ivan [3] => Dragan )
    echo '<br/>';

    // Get some part of the array without changing the array
    print_r(array_slice($students, 0, 1)); // Array ( [0] => Maria )
    echo '<br/>';

    // Change some elements from the array -> This CHANGES the array
    print_r(array_splice($students, 1, 1, array('George'))); // Array( [0] => Petkan )
    echo '<br/>';
    print_r($students); // Array ( [0] => Maria [1] => George [2] => Ivan [3] => Dragan )
    echo '<br/>';

    // Add some elements on some position in the array -> This CHANGES the array
    array_splice($students, 2, 0, array('Petkan')); 
    print_r($students); // Array ( [0] => Maria [1] => George [2] => Petkan [3] => Ivan [4] => Dragan ) 
    echo '<br/>';

    // Remove some element from some index from the array -> This CHANGES the array
    print_r(array_splice($students, 3, 2)); // Array ( [0] => Ivan [1] => Dragan )
    echo '<br/>';
    print_r($students); // Array ( [0] => Maria [1] => George [2] => Petkan ) 
    echo '<br/>';

    // Sort the elements of the array
    sort($students);
    print_r($students); // Array ( [0] => George [1] => Maria [2] => Petkan )
    echo '<br/>';
    echo '<br/>';

    // Convert array to string
    echo implode(', ', $students); // George, Maria, Petkan
    echo '<br/>';
    echo '<br/>';

    // Create associative array
    $student = ['name' => 'Maria', 'age' => 22]; // <=> $student = array('name' => 'Maria', 'age' => 22)
    var_dump($student); // array(2) { ["name"]=> string(5) "Maria" ["age"]=> int(22) } 
    echo '<br/>';
    print_r($student); // Array ( [name] => Maria [age] => 22 ) 
    echo '<br/>';
    echo '<br/>';

    // Loop through indexed array
    foreach($students as $value) {
        echo $value . " ";
    }
    echo '<br/>';

    // Loop through associative array
    foreach($student as $key => $value) {
        echo "$key: $value ";
    }

    // Create two-dimensional indexed array
    $data = [
        ['Компютърна графика с WebGL', 'доц. П. Бойчев'],
        ['Програмиране с Go', 'Николай Бачийски']
    ];

    // Create two-dimensional associative array
    $assocData = [
        'webgl' => [
          'title' => 'Компютърна графика с WebGL',
          'description' => '...',
          'lecturer' => 'доц. П. Бойчев',
        ],
        'go' => [
          'title' => 'Програмиране с Go',
          'description' => '...',
          'lecturer' => 'Николай Бачийски',
        ]
      ];
?>