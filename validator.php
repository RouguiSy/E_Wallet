<?php
    namespace EWallet\Validator;
    
    use function EWallet\Repository\trouverWalletParTelephone;
    use function EWallet\Repository\trouverWalletParCode;
    use function EWallet\Repository\obtenirWalletParIndex;
    
    function validerNom(string $nom): bool {
        return !empty(trim($nom));
    }
    
    function validerTelephone(string $telephone): bool {
        return strlen($telephone) === 9 && ctype_digit($telephone);
    }
    
    function validerSolde(float $solde): bool {
        return $solde >= 0;
    }
    
    function validerCode(int $code): bool {
        return $code > 0;
    }
    
    function validerMontant(float $montant): bool {
        return $montant > 0;
    }
    
    function telephoneExiste(string $telephone): bool {
        return trouverWalletParTelephone($telephone) !== -1;
    }
    
    function codeExiste(int $code): bool {
        return trouverWalletParCode($code) !== -1;
    }
    
    function soldeDisponible(int $indexWallet, float $montant, float $frais): bool {
        $wallet = obtenirWalletParIndex($indexWallet);
        return $wallet["solde"] >= ($montant + $frais);
    }
?>