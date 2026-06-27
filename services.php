<?php
    require_once "validator.php";
    
    function creerWallet(string $nom, string $telephone, float $solde, int $code): bool {
        if (!validerNom($nom))return false;
        if (!validerTelephone($telephone))return false;
        if (telephoneExiste($telephone))return false;
        if (!validerSolde($solde))return false;
        if (!validerCode($code))return false;
        if (codeExiste($code))return false;
    
        $wallet = ["client"=> $nom,"telephone" => $telephone,"solde"=> $solde,"code"=> $code];
        ajouterWallet($wallet);
        return true;
    }
    
    function calculerFrais(float $montant): float {
        if ($montant <= 10000) {
            return 200;
        } elseif ($montant <= 100000) {
            return 500;
        } else {
            $frais = $montant * 0.01;
            if ($frais > 5000) {
                $frais = 5000;
            }
            return $frais;
        }
    }
    
    function faireDepot(string $telephone, float $montant): bool {
        if (!telephoneExiste($telephone)) return false;
        if (!validerMontant($montant))    return false;
    
        $index = trouverWalletParTelephone($telephone);
        $wallet = obtenirWalletParIndex($index);
        $nouveauSolde = $wallet["solde"] + $montant;
    
        mettreAJourSolde($index, $nouveauSolde);
        ajouterTransaction($montant, "depot", $index);
        return true;
    }
    
    function faireRetrait(string $telephone, float $montant): bool {
        if (!telephoneExiste($telephone)) return false;
        if (!validerMontant($montant))    return false;
    
        $frais = calculerFrais($montant);
        $index = trouverWalletParTelephone($telephone);
    
        if (!soldeDisponible($index, $montant, $frais)) return false;
    
        $wallet = obtenirWalletParIndex($index);
        $nouveauSolde = $wallet["solde"] - $montant - $frais;
    
        mettreAJourSolde($index, $nouveauSolde);
        ajouterTransaction($montant, "retrait", $index);
        ajouterTransaction(-$frais, "frais", $index);
        return true;
    }
    
    function listerTransactions(?string $telephone = null): array {
        $toutes = obtenirToutesLesTransactions();
    
        if ($telephone === null) {
            return $toutes;
        }
    
        $index = trouverWalletParTelephone($telephone);
        $filtrees = [];
    
        for ($i = 0; $i < count($toutes); $i++) {
            if ($toutes[$i]["indexClient"] == $index) {
                $filtrees[] = $toutes[$i];
            }
        }
        return $filtrees;
    }
?>