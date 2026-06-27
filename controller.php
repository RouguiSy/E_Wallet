<?php
    namespace EWallet\Controller;

    use function EWallet\Services\creerWallet;
    use function EWallet\Services\faireDepot;
    use function EWallet\Services\faireRetrait;
    use function EWallet\Services\calculerFrais;
    use function EWallet\Services\listerTransactions;

    function controller(string $choix): void {
        match($choix) {
            "1" => formulaireCreerWallet(),
            "2" => formulaireDepot(),
            "3" => formulaireRetrait(),
            "4" => formulaireTransactions(),
            "0" => print("Au revoir !\n"),
            default => print("Choix invalide\n")
        };
    }

    function formulaireCreerWallet(): void {
        $nom       = readline("Nom du client : ");
        $telephone = readline("Numéro de téléphone : ");
        $solde     = (float) readline("Solde initial : ");
        $code      = (int)   readline("Code secret : ");

        creerWallet($nom, $telephone, $solde, $code)? print("Wallet cree  !\n"): print("erreur telephone ou code\n");
    }

    function formulaireDepot(): void {
        $telephone = readline("Numero de telephone : ");
        $montant   = (float) readline("Montant à déposer : ");

        faireDepot($telephone, $montant)? print("Depot de {$montant} fait\n"): print(" numero ou montant invalide.\n");
    }

    function formulaireRetrait(): void {
        $telephone = readline("Numero de telephone : ");
        $montant   = (float) readline("Montant à retirer : ");
        $frais     = calculerFrais($montant);

        echo "Frais appliques : {$frais} \n";

        faireRetrait($telephone, $montant)
            ? print("Retrait de {$montant} effectue. Frais : {$frais} \n")
            : print("solde insuffisant, numero  ou montant invalide.\n");
    }

    function formulaireTransactions(): void {
        $choixFiltre = readline("Filtrer par wallet ? (o/n) : ");

        $transactions = $choixFiltre === "o" ? listerTransactions(readline("Numero de telephone : ")): listerTransactions();

        if (empty($transactions)) {
            echo "Aucune transaction trouvee.\n";
            return;
        }

        echo "\n--- Historique des transactions ---\n";
        array_walk($transactions, function($t) {
            echo "Type : {$t['type']} | Montant : {$t['montant']} \n";
        });
    }
?>