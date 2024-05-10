<?php
class Utilisateurs {
    private $utilisateurs = [];

    // Fonction pour ajouter un nouvel utilisateur
    public function ajouterUtilisateur($nom, $prenom, $email, $motDePasse) {
        // Vérifie si l'utilisateur existe déjà
        if (!isset($this->utilisateurs[$email])) {
            // Ajoute l'utilisateur à la liste des utilisateurs
            $this->utilisateurs[$email] = [
                'nom' => $nom,
                'prenom' => $prenom,
                'motDePasse' => $motDePasse
            ];
            return true; // Retourne vrai si l'utilisateur a été ajouté avec succès
        }
        return false; // Retourne faux si l'utilisateur existe déjà
    }

    // Fonction pour vérifier les informations de connexion
    public function verifierConnexion($email, $motDePasse) {
        // Vérifie si l'utilisateur existe dans la liste des utilisateurs
        if (isset($this->utilisateurs[$email])) {
            // Vérifie si le mot de passe correspond
            if ($this->utilisateurs[$email]['motDePasse'] === $motDePasse) {
                return true; // Retourne vrai si les informations de connexion sont correctes
            }
        }
        return false; // Retourne faux si les informations de connexion sont incorrectes
    }
}

// Vérifie si les données du formulaire ont été soumises pour l'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["inscription"])) {
    // Crée une instance de la classe Utilisateurs
    $gestionUtilisateurs = new Utilisateurs();

    // Récupère les données du formulaire d'inscription
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $motDePasse = $_POST["motDePasse"];

    // Ajoute l'utilisateur
    if ($gestionUtilisateurs->ajouterUtilisateur($nom, $prenom, $email, $motDePasse)) {
        // Redirige l'utilisateur vers la page de connexion après l'inscription réussie
        header("Location: connexion.php");
        exit(); // Arrête l'exécution du script après la redirection
    } else {
        echo "L'utilisateur existe déjà !";
    }
}

// Vérifie si les données du formulaire ont été soumises pour la connexion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["connexion"])) {
    // Crée une instance de la classe Utilisateurs
    $gestionUtilisateurs = new Utilisateurs();

    // Récupère les données du formulaire de connexion
    $emailConnexion = $_POST["emailConnexion"];
    $motDePasseConnexion = $_POST["motDePasseConnexion"];

    // Vérifie les informations de connexion
    if ($gestionUtilisateurs->verifierConnexion($emailConnexion, $motDePasseConnexion)) {
        // Authentification réussie
        // Vous pouvez ajouter du code ici pour rediriger l'utilisateur vers la page principale
        header("Location: index.php");
        exit(); // Arrête l'exécution du script après la redirection
    } else {
        // Authentification échouée
        echo "Adresse e-mail ou mot de passe incorrect !";
    }
}
?>
