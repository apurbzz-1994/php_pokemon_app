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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    </head>
    <body>
        <?php include("connection.php"); ?>
        <div class="container">
            <!--This is the create party div-->
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 search-bar">
                        <form method="post">
                            <input type="text" name="list_name" placeholder="Enter a name for your party">
                            <div id="list-button-div">
                                <input type="submit" value="Create Party" id="list-button"/>
                            </div>
                        </form>
                </div>
                <!--script for inserting list in db-->
                <?php 
                    if(!empty($_POST)){
                        $query = "INSERT INTO `party_list` (`party_title`) VALUES (:partytitle)";
                        $stmt = $dbh->prepare($query);
                        $parameters = [
                            'partytitle' => $_POST['list_name']
                        ];
                        if($stmt -> execute($parameters)){
                            echo "
                                <script>
                                    window.alert(\"List was created successfully.\");
                                </script>
                            ";
                        }
                    }
                ?>
            </div>
            <!--This is the party list view div-->
            <div class="row">
                <!--Generating the stored list-->
                <?php 
                $listQuery = "SELECT * FROM `party_list`";
                $listStmt = $dbh->prepare($listQuery);
                //execute the shit
                $listStmt -> execute();
                if($listStmt->rowCount() > 0){
                    $party_array = $listStmt -> fetchAll();?>
                <!--Populating-->
                <?php foreach($party_array as $party){ ?>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class = "row party-card">
                            <div class="col-12 col-md-4 col-lg-4">
                                <!--Name and possible description goes here-->
                                <h3><?= $party['party_title'] ?></h3>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <!--Pokemon list goes here-->
                                <?php 
                                    $memberQuery = "SELECT pokemon.name AS name, pokemon.type_1 AS type, party_member.member_nickname AS nickname 
                                    FROM pokemon JOIN party_member on (pokemon.id=party_member.pok_id AND py_id=?);";
                                    $memberStmt = $dbh -> prepare($memberQuery);
                                    $memberStmt -> execute([$party['py_id']]);
                                    if($memberStmt -> rowCount() > 0){ 
                                        $all_pokemon = $memberStmt -> fetchAll();?>
                                    <?php foreach($all_pokemon as $pokemon){ ?>
                                        <div>
                                            <h4><?= $pokemon['name'] ?></h4>
                                            <p><?= $pokemon['nickname'] ?></p>
                                            <p><?= $pokemon['type'] ?></p>
                                        </div>

                                    <?php } ?>
                                    <?php } else{ ?>
                                        <!--Message if no pokemon belongs to that list-->  
                                        <div>
                                            <p>No pokemon has been added to the list as of now.</p>
                                        </div>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>

                <?php } //end of foreach ?>

                <?php } else{
                    
                }?>
                
            </div>
        </div>
    </body>
    
</html>