<?php
    namespace EWallet\Repository;

    $wallets = [];
    $transactions = [];

    function ajouterWallet(array $wallet): void {
        global $wallets;
        array_push($wallets, $wallet);
    }

    function trouverWalletParTelephone(string $telephone): int {
        global $wallets;
        $resultats = array_filter($wallets, function($w) use ($telephone) {
            return $w["telephone"] === $telephone;
        });
        if (empty($resultats)) return -1;
        return array_key_first($resultats);
    }

    function trouverWalletParCode(int $code): int {
        global $wallets;
        $resultats = array_filter($wallets, function($w) use ($code) {
            return $w["code"] === $code;
        });
        if (empty($resultats)) return -1;
        return array_key_first($resultats);
    }

    function mettreAJourSolde(int $index, float $nouveauSolde): void {
        global $wallets;
        $wallets[$index]["solde"] = $nouveauSolde;
    }

    function ajouterTransaction(float $montant, string $type, int $indexClient): void {
        global $transactions;
        array_push($transactions, ['montant'=> $montant,'type'=> $type,'indexClient' => $indexClient
        ]);
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