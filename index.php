<!DOCTYPE html>
<?php
    require_once 'connec.php';
    /*get values from from*/
    if (filter_has_var(INPUT_POST, 'firstname') &&
        filter_has_var(INPUT_POST, 'lastname') ) {

        $pdo = new \PDO(DSN, USER, PASS);

        $statement = $pdo->prepare('INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)');
        
        $statement->bindValue(':firstname', $_POST['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $_POST['lastname'], \PDO::PARAM_STR);
    
        $statement->execute();
        header('index.php');
    } 

    /*get values from database and display it*/
    $query = "SELECT * FROM friend";
    $statement = $pdo->query($query);
    $friends = $statement->fetchAll();
    echo '<ul>';
    foreach ($friends as $friend) {
        echo '<li>' .$friend ['firstname'] . ' ' . $friend['lastname'] .'</li>';
    };
    echo '</ul>';

    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <form action="" method="POST">
        <div>
            <label for="firstname">Your firstname</label>
            <input type="text" name="firstname" id="firstname">
        </div>
        <div>
            <label for="lastname">Your lastname</label>
            <input type="text" name="lastname" id="lastname">
        </div>
        <div>
            <input type="submit" value="Go, send!">
        </div>
    </form>
    <?php
        ?>

    
</body>
</html>


