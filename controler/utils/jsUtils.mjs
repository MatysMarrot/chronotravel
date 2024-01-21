export async function retreiveSession(){
    return await fetch("../../serveurs/retreiveSession.php", {
        method: "POST",
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    }).then(reponse => {
        return reponse.json()
    });
}