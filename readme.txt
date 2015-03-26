RssReader : Antoine CORNELLE & Adrien POURCHER-PORTALIER

Les bases de données de dev et de test sont accesible via les scripts :
    rssbdd_POURCHER_CORNELLE.sql
    rssbdd_test_POURCHER_CORNELLE.sql
La configuration de ces deux connexions est faite dans les fichiers :
    RssReader/src/domain/Connection.php
    RssReader/test/ConnectionTest.php
Les données de connexion sont des constantes de ces deux classes visant les deux bdd précédentes.

Les tests unitaires sont dans le dossier RssReader/test/

- Le projet permet d'ajouter des feeds via l'interface html et grâce à l'api.
- Le projet permet de lister tous les items des feeds précédemment enregistrées.
- Le projet peut lors de l'ajout ou du rafraichissement de la page recharger les items des feeds connues,
et donc ajouter les nouvelles et mettre à jour les anciennes.
- Le projet ne remonte que les 20 derniers items toutes feeds confondues.
- Les catégories sont juste là pour montrer indirectement les feeds et ne sont pas un facteur de tri.
- Il peut normalement retourner en fonction de l'header du contenu html ou du json.

