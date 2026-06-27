<?php
    require_once "services.php";

    function controller(string $choix): void {
        if ($choix == "1") {
            $nom       = readline("Nom du client : ");
            $telephone = readline("Numéro de telephone : ");
            $solde     = (float) readline("Solde initial : ");
            $code      = (int) readline("Code secret : ");

            if (creerWallet($nom, $telephone, $solde, $code)) {
                echo "Wallet créé avec succès !\n";
            } else {
                echo "erreur de numero ou de code.\n";
            }

        } elseif ($choix == "2") {
            $telephone = readline("Numero de telephone : ");
            $montant   = (float) readline("Montant a deposer : ");

            if (faireDepot($telephone, $montant)) {
                echo "Depot valide !\n";
            } else {
                echo "numero introuvable ou montant invalide.\n";
            }

        } elseif ($choix == "3") {
            $telephone = readline("Numero de telephone : ");
            $montant   = (float) readline("Montant a retirer : ");
            $frais     = calculerFrais($montant);

            echo "Frais : {$frais} CFA\n";

            if (faireRetrait($telephone, $montant)) {
                echo "Retrait valide.\n";
            } else {
                echo "solde insuffisant \n";
            }

        } elseif ($choix == "4") {
            $choixFiltre = readline("Voir toutes les transactions ? (o/n) : ");

            if ($choixFiltre == "n") {
                $telephone    = readline("Numero de telephone : ");
                $transactions = listerTransactions($telephone);
            } else {
                $transactions = listerTransactions();
            }

            if (count($transactions) == 0) {
                echo "Aucune transaction trouvee.\n";
            } else {
                echo "\n--- Historique des transactions ---\n";
                for ($i = 0; $i < count($transactions); $i++) {
                    $t = $transactions[$i];
                    echo "Type : {$t['type']} | Montant : {$t['montant']} CFA\n";
                }
            }

        } elseif ($choix == "0") {
            echo "Au revoir !\n";

        } else {
            echo "Choix invalide\n";
        }
    }
?>