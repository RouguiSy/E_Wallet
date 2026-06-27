<?php
    namespace EWallet\Services;

    use function EWallet\Validator\validerNom;
    use function EWallet\Validator\validerTelephone;
    use function EWallet\Validator\validerSolde;
    use function EWallet\Validator\validerCode;
    use function EWallet\Validator\validerMontant;
    use function EWallet\Validator\telephoneExiste;
    use function EWallet\Validator\codeExiste;
    use function EWallet\Validator\soldeDisponible;
    use function EWallet\Repository\ajouterWallet;
    use function EWallet\Repository\trouverWalletParTelephone;
    use function EWallet\Repository\obtenirWalletParIndex;
    use function EWallet\Repository\mettreAJourSolde;
    use function EWallet\Repository\ajouterTransaction;
    use function EWallet\Repository\obtenirToutesLesTransactions;

    function creerWallet(string $nom, string $telephone, float $solde, int $code): bool {
        if (!validerNom($nom)) return false;
        if (!validerTelephone($telephone))return false;
        if (telephoneExiste($telephone))return false;
        if (!validerSolde($solde))return false;
        if (!validerCode($code))return false;
        if (codeExiste($code))return false;

        ajouterWallet(["client"=> $nom,"telephone" => $telephone,"solde"=> $solde,"code"=> $code]);
        return true;
    }

    function calculerFrais(float $montant): float {
        return match(true) {
            $montant <= 10000  => 200,
            $montant <= 100000 => 500,
            default   => min($montant * 0.01, 5000)
        };
    }

    function faireDepot(string $telephone, float $montant): bool {
        if (!telephoneExiste($telephone)) return false;
        if (!validerMontant($montant))    return false;

        $index        = trouverWalletParTelephone($telephone);
        $wallet       = obtenirWalletParIndex($index);
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

        $wallet       = obtenirWalletParIndex($index);
        $nouveauSolde = $wallet["solde"] - $montant - $frais;

        mettreAJourSolde($index, $nouveauSolde);
        ajouterTransaction($montant, "retrait", $index);
        ajouterTransaction(-$frais, "frais", $index);
        return true;
    }

    function listerTransactions(?string $telephone = null): array {
        $toutes = obtenirToutesLesTransactions();

        if ($telephone === null) return $toutes;

        $index = trouverWalletParTelephone($telephone);

        return array_values(
            array_filter($toutes, function($t) use ($index) {
                return $t["indexClient"] === $index;
            })
        );
    }
?>