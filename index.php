<?php
    require_once "repository.php";
    require_once "validator.php";
    require_once "services.php";
    require_once "controller.php";
    
    use function EWallet\Controller\controller;
    
    function afficherMenu(): void {
        echo "\n-------------- Menu Distributeur ----------------\n";
        echo "1 - Créer Wallet\n";
        echo "2 - Faire Dépôt\n";
        echo "3 - Faire Retrait\n";
        echo "4 - Lister les Transactions\n";
        echo "0 - Quitter\n";
    }
    
    do {
        afficherMenu();
        $choix = (int)readline("Faites un choix : ");
        controller($choix);
    } while ($choix != 0);
?>