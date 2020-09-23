function fetchAllPokemonCards(){
    let pokemonCardList = document.getElementsByClassName("pokemon-card");
    return pokemonCardList;
}

function checkForPokemonMatch(searchTerm, pokeCard){

    
    let pokeName = pokeCard.getElementsByTagName("h5")[0];
    console.log(pokeName);
    if(pokeName){
        let pokeNameTextValue = pokeName.textContent || pokeName.innerHTML;
        if (pokeNameTextValue.toUpperCase().indexOf(searchTerm) > -1) {
            return true;
        } else {
            return false;
        }
    }
}

//this should get executed when user types stuff on search bar
function searchForPokemon(){
    let pokeArray = fetchAllPokemonCards();
    //get the user input:
    let userInput = document.getElementById("pokesearch").value.toUpperCase();
    for(var i=0;i<pokeArray.length;i++){
        if(checkForPokemonMatch(userInput, pokeArray[i])){
            pokeArray[i].parentElement.style.display = "";
        }
        else{
            pokeArray[i].parentElement.style.display = "none";
        }
    }
}