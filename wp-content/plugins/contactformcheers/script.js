document.getElementById("submit").addEventListener("click", function(event){
    event.preventDefault();
    var email = document.getElementById("emailadress").value;
    var navn = document.getElementById("fullname").value;
    var besked = document.getElementById("besked").value;
    alert(navn + " Tak for din besked: " + besked);

});

  

