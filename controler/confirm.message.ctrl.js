function confirmMessage() {
    // Utiliser la fonction window.confirm() pour afficher une boîte de dialogue
    var confirmation = window.confirm("Êtes-vous sûr de vouloir supprimer "+ +"?");

    // Si l'utilisateur clique sur OK, confirmation sera true, sinon false
    if (confirmation) {
        // Obtenez le formulaire et définissez la valeur du champ "delete"
        var form = document.getElementById("deleteForm");
        form.elements["delete"].value = form.getAttribute("data-student-id");

        form.submit();
    } else {
        alert("Suppression annulée.");
    }
}