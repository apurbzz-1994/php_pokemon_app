<html>
    <head>
        <title>Pokemon Database</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto Condensed">
        <script src="script.js"></script>

    </head>
    <body>
        <?php  
            include("connection.php");
            //setting the database stuff
            $query = "select * from `pokemon` limit 386";
            $stmt = $dbh -> prepare($query);
            $stmt -> execute(); 
            $pokemon_array = $stmt -> fetchAll();
        ?>
        <div class="container">
            <div class="row search-bar">
                <div class="col-12 col-md-12 col-lg-12">
                    <!--The search bar input-->
                    <input type="text" id="pokesearch" name="pokesearch" placeholder="Search for Pokemon" onkeyup="searchForPokemon()">
                </div>
            </div>
            <div class="row">
                <?php foreach($pokemon_array as $pokemon){ ?>
                    <div class="col-12 col-md-6 col-lg-3 ind-row-margin">
                        <?php 
                        $poke_type = strtolower($pokemon['type_1']);  
                        //this is the div for each pokemon card  
                        //echo "<div class=\"pokemon-card $poke_type\" onclick=\"location.href=\'dashboard.php\';\" style=\"cursor: pointer;\">";   
                        ?>
                        <div class="pokemon-card <?= $poke_type ?>" onclick="location.href='dashboard.php?id=<?= $pokemon['id'] ?>';" style="cursor: pointer;">
                            <h5><?= $pokemon['name']   ?></h5>
                            <?php $poke_name = strtolower($pokemon['name']); 
                            //fixing for specific pokemon
                            $nidoranF = "29";
                            $nidoranM = "32";
                            $mrMime = "122";
                            $farFetched = "83";
                            
                            if(strcasecmp($pokemon['poke_id'], $nidoranF) == 0){
                                echo "<img src=\"https://img.pokemondb.net/sprites/ruby-sapphire/normal/nidoran-f.png\" alt=\"$poke_name\" class=\"responsive-poke-img\">";
                            }
                            else if(strcasecmp($pokemon['poke_id'], $nidoranM) == 0){
                                echo "<img src=\"https://img.pokemondb.net/sprites/ruby-sapphire/normal/nidoran-m.png\" alt=\"$poke_name\" class=\"responsive-poke-img\">";
                            }
                            else if(strcasecmp($pokemon['poke_id'], $mrMime) == 0){
                                echo "<img src=\"https://img.pokemondb.net/sprites/ruby-sapphire/normal/mr-mime.png\" alt=\"$poke_name\" class=\"responsive-poke-img\">";
                            }
                            else if(strcasecmp($pokemon['poke_id'], $farFetched) == 0){
                                echo "<img src=\"https://img.pokemondb.net/sprites/ruby-sapphire/normal/farfetchd.png\" alt=\"$poke_name\" class=\"responsive-poke-img\">";
                            }
                            else{
                                echo "<img src=\"https://img.pokemondb.net/sprites/ruby-sapphire/normal/$poke_name.png\" alt=\"$poke_name\" class=\"responsive-poke-img\">";
                            }
                            ?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </body>
</html>