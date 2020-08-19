# Contacts

Annuaire inversé ++

## Description

Contacts est une tout petite application web qui offre un système de stockage et gestion de contacts dans un annuaire lié à un utilisateur. A l&#39;intérieur d&#39;un annuaire la recherche de contacts peut se faire en tenant compte aussi bien du numéro téléphonique que du nom (prénom et/ou nom de famille) du contact, comme dans un annuaire inversé.

## L&#39;application

Dans la version actuelle l&#39;application se divise en deux parties, un backoffice qui sert à administrer les comptes d&#39;utilisateur (annuaires) et une API REST qui permet les actions CRUD dans les annuaires.

### L&#39;API

L&#39;API est seulement accessible aux utilisateurs ayant un compte (ROLE_USER). Le login est géré par un JWT Token chiffre en double clef (privé/publique).

Attention : Remplacez le « … » par le host.

#### Fonctionnalités principales

##### Login_token - POST

…/api/login_token

JSON body

{

    &quot;username&quot;: &quot;useremail&quot;,

    &quot;password&quot;: &quot;userpassword&quot;

}

Response

JWT token. Exemple

{

    &quot;token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1OTc3NzAxMTYsImV4cCI6MTU5Nzc3MzcxNiwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoidXNlcjFAZXhlbXBsZS5mciJ9.WD55MiL3TEuHk8AhNTt1kibbGvNt97HzMgApmJ7F3msaeS5KbLXUVY9p2m7299wI\_27cLQ1TSPjhFaARtUTiSA8tixUYP6qFIbCedyOUJFGLdMYG\_l\_lufjUaoUa4hImHWLPDQiUQil29CF3pOdkm-x3d\_QuCNWGiqraVdLXAX7jhaMMyu6qVyiGlZtg\_tBl8gmUXMRg-iIOBIeyrlu2wUsFjIdsJD6ToETIeyjJ6h8Y\_Nhe4uo42nKlCmdSLzkEw32d14EgzenT3mV9UQqRfIX\_8rcoqgBP9F25tMUVqlipMSmBuJKdCFAw0I4VliSOQldvGX5SYIfR\_-m0oyUUJeaXwyuI0wbeMpengjDl0kWkFdsu7xHdvdtB-9xqkzZVEEi5XwuiFRpdE5D1pKKJX1tmOs6clvkpCDVX52xfP2RGU\_X1Ek9t1RlG1NjVBhBwMB286yxkdgP\_NE3rI9Zqw0ux-zKB60DniSM1oUxNPLsbZYIX1o2GXBrJig1nEWLJ8KL29d\_w0xg2i61-PcIvZ8mRewUU8rMEkM\_6SNkQbEto4kWcnIH2R-FIQcm\_g5pP-BuUfKzjjF0npzeLlFF3IBrU8QVtOITWUFAEc0TDYmzRGxzIRJMULwFmcEpdd-TyXYrQdo3\_eo2CWrqwCO9jpp2GlR5n-m41I-OkxptIEOk&quot;

}

##### GET collection

…/api/contacts

Réponse :

JSON avec les contacts de l&#39;annuaire de l&#39;utilisateur connecté.

##### GET item

…/api/contacts/15

Réponse :

Renvoie le JSON du contact, correspond à l&#39;id saisi, seulement si celui-ci est dans l&#39;annuaire de l&#39;utilisateur connecté, en cas contraire l&#39;accès est interdit.

##### GET Recherche par phone

…/api/contacts?phone=03 25

##### GET Recherche par lastName

…/api/contacts?lastName=Rui

##### POST

/api/contacts

Avec le BODY

{

&quot;firstName&quot;: &quot;Test&quot;,

&quot;lastName&quot;: &quot;Osterone&quot;,

&quot;phone&quot;: &quot;12345678910&quot;,

&quot;email&quot;: &quot;email@exemple.fr&quot;,

&quot;address&quot;: &quot;10 rue Paradis&quot;,

&quot;user&quot;: &quot;/api/users/33&quot;

}

Crée un nouveau contact dans l&#39;annuaire.

##### PUT

La requête POST avec le changement du verbe en PUT, sert à modifier un contact.

##### DELETE

…/api/contacts/15

Supprime l&#39;utilisateur.

Un fichier JSON avec un exemple pour chaque requête en POSTMAN est disponible dans le dossier de tests.

#### Choix Techniques

API Platform pour le montage de la structure de l&#39;API.

Sécurité gestionné par VOTER

### BackOffice

#### Fonctionnalités principales

##### Gestions des contacts dans un annuaire personnel

Ensemble d&#39;opérations CRUD sur les contacts et sur les annuaires qui sont une propriété des utilisateurs. Le backoffice est limité aux utilisateurs ayant le rôle d&#39;administrateur.

##### Login

Un système de sécurité par _path_ gère l&#39;accès aux routes de l&#39;administration. Pour y accéder l&#39;utilisateur doit fournir les crédenciales d&#39;utilisateur admin.

###### Rôles

Les utilisateurs peuvent avoir le rôle &#39;ROLE_USER&#39; ou &#39;ROLE_ADMIN&#39;. L&#39;administrateur peut exécuter l&#39;ensemble d&#39;opérations CRUD aussi bien sur les utilisateurs que sur les annuaires.

###### Pages

_Dashboard_

Offre un message de bienvenue et un formulaire de recherche (inversé) dans l&#39;ensemble des annuaires. Recherche en AJAX et construction dynamique d&#39;une liste de résultats.

_MyContacts_

Liste des contacts de l&#39;utilisateur connecté avec les liens vers le _show_, l*edit* et la suppression directe.

_Directories_

Liste des annuaires disponibles en basse de donnés avec les liens vers _le show,_ l&#39;_edit_ et la suppression directe.

Une barre de navigation permet de se déplacer entre les différentes pages ainsi que se déconnecter.

_Create / edit_

Chaque entité (User et Contact) dispose d&#39;une page avec un formulaire de création et une autre page avec un formulaire d&#39;édition.

Quelques valeurs comme la date de création sont introduites automatiquement par l&#39;application. C&#39;est aussi le cas pour le password d&#39;un nouvel utilisateur.

#### Choix Techniques

Symfony 5 et Bootstrap 4

## Evolution

Développement d&#39;une application front (Angular / Vue).

Délier les annuaires des utilisateurs dans une entité indépendante

Multiples annuaires par utilisateurs

Visibilité des annuaires public/privé au choix
