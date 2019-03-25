<?php
    // Host name
    $host = "localhost";
    // DB user name
    $userName = "root";
    // DB user password
    $password = "";
    // DB name
    $dbname = "webtech";

    try {
        // Connect to DB

        // Uncomment when creating DB for the first time
        // $connection = new PDO("mysql:host=$host", $userName, $password, 
        //               array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $connection = new PDO("mysql:host=$host;dbname=$dbname", $userName, $password, 
                      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); // Set UTF-8 encoding on data

        // Set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create DB. Always set UTF-8 encoding!!!
        // $sql = "CREATE DATABASE webTech CHARACTER SET utf8 COLLATE utf8_general_ci;";
        // $connection->exec($sql);

        // Create table
        $sql = "CREATE TABLE users(
            userName VARCHAR(30) NOT NULL PRIMARY KEY,
            password VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP
            )";
        $connection->exec($sql);

        $sql = "CREATE TABLE students(
            fn INT(6) UNSIGNED, 
            userName VARCHAR(30) NOT NULL,
            firstName VARCHAR(30) NOT NULL,
            lastName VARCHAR(50) NOT NULL,
            year INT(1) NOT NULL,
            bachelorProgram VARCHAR(100) NOT NULL,
            PRIMARY KEY (fn),
            FOREIGN KEY(userName) REFERENCES users(userName) ON UPDATE CASCADE
            )";
        $connection->exec($sql);

        // Insert data using indexed prepared statements
        $statement = $connection->prepare("INSERT INTO users (userName, password, email) VALUES (?, ?, ?)");
        $statement->execute(["ivgerves", password_hash("s0m3Rand0mPa$$", PASSWORD_DEFAULT), "ivgerves@gmail.com"]);
        $statement->execute(["marcheto", password_hash("an0th3rRand0mPa$$", PASSWORD_DEFAULT), "marcheto@gmail.com"]);

        $students = [
            ["fn" => 62888, "userName" => "ivgerves", "firstName" => "Ivan", "lastName" => "Ivanov", "year" => 3, "bachelorProgram" => "Software Engineering"],
            ["fn" => 62900, "userName" => "marcheto", "firstName" => "Maria", "lastName" => "Georgieva", "year" => 3, "bachelorProgram" => "Software Engineering"]
        ];

        // Insert data in transaction using named prepared statements

        $connection->beginTransaction();

        $statement = $connection->prepare("INSERT INTO students (fn, userName, firstName, lastName, year, bachelorProgram) VALUES (:fn, :userName, :firstName, :lastName, :year, :bachelorProgram)");
        foreach($students as $value) {
            $statement->execute($value);
        }

        $connection->commit();

        // Retrive data using JOIN query
        $sql = "SELECT firstName, lastName, fn, email FROM students, users WHERE students.userName = users.userName";
        $result = $connection->query($sql);

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row["fn"] . " " . $row["firstName"] . " " . $row["lastName"] . " " . $row["email"] . "<br/>";
        }

        // Delete data from table using named prepared statements
        $statement = $connection->prepare("DELETE from students WHERE fn=:fn");
        $statement->execute(["fn" => 62900]);

        // Update data 
        $statement = $connection->prepare("UPDATE students SET year=:year WHERE fn=:fn");
        $statement->execute(["year" => 4, "fn" => 62888]);

        // Drop table
        $sth = $connection->exec("DROP TABLE students");
        $sth = $connection->exec("DROP TABLE users");

        // Drop DB
        $sth = $connection->exec("DROP DATABASE webtech");
    } catch(PDOException $e){
        // Catch errors and print the error message
        echo "Connection failed: " . $e->getMessage();

        // Rollback the data from the transaction (don't change the data)
        $connection->rollBack();
    }

    $connection = null;
?>