<?php
    require_once "repository.php";
    
    function validerNom(string $nom): bool {
        if ($nom == "") return false;
        return true;
    }
    
    function validerSolde(float $solde): bool {
        if ($solde < 0) return false;
        return true;
    }
    
    function validerCode(int $code): bool {
        if ($code <= 0) return false;
        return true;
    }
    
    function validerTelephone(string $telephone): bool {
        if (strlen($telephone) != 9) return false;
        return true;
    }
    
    function telephoneExiste(string $telephone): bool {
        if (trouverWalletParTelephone($telephone) == -1) return false;
        return true;
    }
    
    function codeExiste(int $code): bool {
        if (trouverWalletParCode($code) == -1) return false;
        return true;
    }
    
    function validerMontant(float $montant): bool {
        if ($montant <= 0) return false;
        return true;
    }
    
    function soldeDisponible(int $indexWallet, float $montant, float $frais): bool {
        $wallet = obtenirWalletParIndex($indexWallet);
        if ($wallet["solde"] < ($montant + $frais)) return false;
        return true;
    }
?>