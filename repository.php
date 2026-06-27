<?php
    $wallets = [
        ["client" => "Rougui Sy", "telephone" => "773438165", "solde" => 2345, "code" => 2005],
        ["client" => "fatou wane","telephone" => "773438165","solde" => 2345,"code" => 2005]
    ];
    
    $transactions = [
        ['montant' => 1000, 'type' => 'depot', 'indexClient' => 0],
        ['montant' => -5000, 'type' => 'retrait', 'indexClient' => 0]
    ];
    
    function ajouterWallet(array $wallet): void {
        global $wallets;
        $wallets[] = $wallet;
    }
    
    function trouverWalletParTelephone(string $telephone): int {
        global $wallets;
        for ($index = 0; $index < count($wallets); $index++) {
            if ($wallets[$index]["telephone"] == $telephone) {
                return $index;
            }
        }
        return -1;
    }
    
    function trouverWalletParCode(int $code): int {
        global $wallets;
        for ($index = 0; $index < count($wallets); $index++) {
            if ($wallets[$index]["code"] == $code) {
                return $index;
            }
        }
        return -1;
    }
    
    function mettreAJourSolde(int $index, float $nouveauSolde): void {
        global $wallets;
        $wallets[$index]["solde"] = $nouveauSolde;
    }
    
    function ajouterTransaction(float $montant, string $type, int $indexClient): void {
        global $transactions;
        $transactions[] = [
            'montant'     => $montant,
            'type'        => $type,
            'indexClient' => $indexClient
        ];
    }
    
    function obtenirWalletParIndex(int $index): array {
        global $wallets;
        return $wallets[$index];
    }
    
    function obtenirToutesLesTransactions(): array {
        global $transactions;
        return $transactions;
    }
?>