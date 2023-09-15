<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordSagar.com</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header class="name">
        <h1>Word Sagar</h1>
    </header>
    <form action="search.php" method="post">
        <input type="text" name="word" placeholder="Worden me">
        <input type="submit" value="Search">
    </form>
    <div class="container">
        <div class="php-container">
            <?php
            include "databaseConnector.php"; // importing the database
            //query
            $stmt = $dbh->query("select word,syllable,meaning,pname,example,synonym,antonym,sname,image,Lhindi,Ltamil,Lgujrati from words join wmeaning on wid=w_id join parts_of_speech on pid = p_id join wdescription on wid = wnum  and dno = mid join wlanguage on wid = wno and lid = dno where word = '$search'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {  // checks if the word existsb in the database or not
                echo '<div class="word-container">'; //main content of the output start
                echo '<div class="word-basic">';
                echo $result[0]['word'] . "<br>";
                echo "(";
                echo $result[0]['syllable'];
                if ($result[0]['sname']) {
                    echo ", ".$result[0]['sname'];
                }
                echo " )";
                echo "</div>";
                foreach($result as $row) { 
                    if($row['image']){      // image output
                        echo '<div class="img">';
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
                        echo '</div>';
                    }
                    echo "</div>";
                    echo '<div class = "detail-container">';
                    echo '<div class = "word-details">';
                    echo "Meaning ( " . $row['pname'] . " )  : ";
                    echo $row['meaning'] . "<br>";
                    echo "Example : " . $row['example'] . "<br>";
                    echo "Synonym : " . $row['synonym'] . "<br>";
                    if($row['antonym']){
                        echo "Antonym : " . $row['antonym'] . "<br>";
                    }
                    echo "Hindi : ".$row['Lhindi']."<br>";
                    echo "Tamil : ".$row['Ltamil']."<br>";
                    echo "Gujrati : ".$row['Lgujrati']."<br>";
                    echo "</div>";
                }
                echo '</div>';  // main content of the output end;
            }
            else if(!$search){ //checks if the user entered something or not
                echo "you have not entered anything please enter again";
            } else { // if the word is not found in the database
                echo "Word not found";
            }
            ?>
        </div>
</body>

</html>