<?php

/**
 * Vérifie qu'une chaîne ne contient que des 0 et des 1.
 */
function isBinary(string $s): bool {
    return preg_match('/^[01]+$/', $s) === 1;
}

/**
 * Exécute l'opération binaire demandée et renvoie la chaîne binaire résultat.
 *
 * @throws InvalidArgumentException si les entrées ne sont pas valides ou division par zéro.
 */
function calculateBinary(string $a_bin, string $b_bin, string $op): string {
    // Validation
    if (!isBinary($a_bin) || !isBinary($b_bin)) {
        throw new InvalidArgumentException('Inputs must be binary strings.');
    }
    $a = bindec($a_bin);
    $b = bindec($b_bin);

    // Division par zéro
    if ($op === 'div' && $b === 0) {
        throw new InvalidArgumentException('Division by zero.');
    }

    // Exécution
    switch ($op) {
        case 'add':
            return decbin($a + $b);
        case 'sub':
            $r = $a - $b;
            if ($r >= 0) {
                return decbin($r);
            }
            // Par exemple sur 8 bits en deux compléments
            $bits = 8;
            return substr(decbin($r & ((1 << $bits) - 1)), -$bits);
        case 'mul':
            return decbin($a * $b);
        case 'div':
            $quot = intdiv($a, $b);
            $rem  = $a % $b;
            $res  = decbin($quot);
            if ($rem !== 0) {
                $res .= ' (quotient) ; reste = ' . decbin($rem);
            }
            return $res;
        case 'and':
            return decbin($a & $b);
        case 'or':
            return decbin($a | $b);
        case 'xor':
            return decbin($a ^ $b);
        default:
            throw new InvalidArgumentException('Unknown operation.');
    }
}
