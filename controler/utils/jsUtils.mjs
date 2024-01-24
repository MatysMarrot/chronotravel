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

export function retrieveSessionFromDiv(){
    try{
        let div = document.getElementById("session");
        return JSON.parse(div.textContent);
    }catch (error){
        return null;
    }
}