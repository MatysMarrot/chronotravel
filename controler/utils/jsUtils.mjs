export async function retreiveSession(){
    return await fetch("../serveurs/retreiveSession.php", {
        method: "POST",
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    }).then(function (reponse) {
        console.log(reponse);
        return reponse.json();
    }).catch(error => console.log(error));
}