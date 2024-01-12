#!/bin/bash

#TODO : add le fichier au gitignore psq ça doit pas arriver sur le serveur.
# INFOS MACHINE
user="atikr"
host="192.168.14.112"
port="22"  # Par défaut, le port SSH est 22, à vérifier si c'est bien le port utilisé, mais ça m'a l'air bon.
#         Faut une clé ssh dcp, pas de mdp dans un tel fichier

# GETTING "repo_local" AS CURRENT REPOSITORY (SCRIPT MUST BE EXECUTED IN THE CURRENT REPO) (might change in the future)
repo_local="."

# GETTING THE CURRENT BRANCH
branche_actuelle=$(git -C "$repo_local" rev-parse --abbrev-ref HEAD)

# On met les fichiers sur root du coup ? Ou dans les fichiers de l'utilisateur atikr? à clarifier avec Reda

# Chemin sur la machine distante où le référentiel sera copié
repo_distante="/var/www/html/Projet_Sae/$branche_actuelle"

#  S'assurer qu'on ait bien mit rsync sur la machine qu'on utilise
# Utiliser rsync pour copier le référentiel vers le dossier de la branche
rsync -avz -e "ssh -p $port" "$repo_local/" "$user@$host:$repo_distante/"

# Vérifier si la commande rsync s'est bien exécutée
if [ $? -eq 0 ]; then
    echo "Copie réussie vers la machine distante dans le dossier de la branche $branche_actuelle."
else
    echo "Échec de la copie vers la machine distante."
fi