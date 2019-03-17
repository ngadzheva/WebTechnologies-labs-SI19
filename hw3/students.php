<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Домашно 1.2 - Electives</title>
    </head>

    <body>
        
        <?php
            require "add.php";


            $pageID = (isset($_GET['page']) ? $_GET['page'] : null);

            if($pageID){
                $form = `<fieldset>
                        <legend>Add</legend>
                        <form method="GET" action="add.php">
                            <label for="name">Name</label>
                            <input type="text" name="name"/>
                            <label for="mark">Mark</label>
                            <input type="text" name="mark"/>
                            <input type="submit" value="Add"/>
                        </form>
                    </fieldset>`;

                echo $form;
            } else {
                $list = '<ol>';

                $students = show();

                foreach($student as $key => $value) {
                    $list = $list . '<li>'. $student[$key]['name'] . ': ' . $student[$key]['mark'] . '</li>';
                }

                $list = $list . '</ol>';

                echo $list;
            }
        ?>
    </body>
</html>
