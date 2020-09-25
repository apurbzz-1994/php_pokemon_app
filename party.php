<html>
    <head>
        <title>Your Party Lists</title>
        <title>Pokemon Database</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto Condensed">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                        <form method="post">
                            <input type="text" name="list_name" placeholder="Enter a name for your party">
                            <input type="submit" value="Create Party"/>
                        </form>
                </div>
                    <?php
                    include("connection.php");
                    //checks if the user has pressed the create party button or not 
                    if(!empty($_POST["list_name"])){
                        //create the query
                        $query = "INSERT INTO `party_list`(`party_title`) VALUES (:partytitle)";
                        $stmt = $dbh->prepare($query);
                        $parameters = [
                            'partytitle' => $_POST['list_name']
                        ];
                        //execute the fucking query
                        if($stmt -> execute($parameters)){
                            echo "
                            <div class=\"col-12 col-md-12 col-lg-12\">
                                <p>List was created successfully</p>
                            </div>";
                        };
                    }?>
                    <!--Generating the stored lists-->
                    <?php 
                    $listQuery = "SELECT * FROM `party_list`";
                    $listStmt = $dbh -> prepare($listQuery);
                    $listStmt -> execute();
                    if($listStmt-> rowCount() > 0){
                        $party_array = $listStmt -> fetchAll();
                    ?>

                    <?php foreach($party_array as $party){ ?>
                        <h2><?= $party['party_title'] ?></h2>
                    <?php } //end of forach loop ?>
                    <?php } else {
                        echo "<p>No party lists have been created yet</p>";
                    }?>
            </div>
        </div>
    </body>
    
</html>