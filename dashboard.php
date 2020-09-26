<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto Condensed">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <title>Add to list</title>
</head>

<body>
    <?php include("connection.php"); ?>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form method="post">
                <input type="text" name="nick_name" placeholder="Give your pokemon a nickname">
                <!--php code for populating selection with party from db-->
                <?php 
                $query = "SELECT * FROM `party_list`";
                $stmt = $dbh -> prepare($query);
                $stmt -> execute();

                if($stmt -> rowCount() > 0){
                    $party_list_array = $stmt -> fetchAll();
                
                ?>
                <select name="party_select">
                    <?php foreach($party_list_array as $party){ ?>
                        <option><?= $party['party_title'] ?></option>
                    <?php } ?>
                </select>
                <?php } else{ ?>
                    <div>
                        <p>No parties created yet</p>
                    </div>
                <?php } ?>

                <input type="submit" value="Add to party">
            </form>
        </div>
    </div>
</body>

</html>