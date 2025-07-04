<?php
// Fonction de validation : chaîne ne contenant que des 0 et des 1
function isBinary(string $s): bool {
    return preg_match('/^[01]+$/', $s) === 1;
}

// Initialisation des variables
$error   = '';
$result  = '';
$a_bin   = $_POST['a_bin']   ?? '';
$b_bin   = $_POST['b_bin']   ?? '';
$op      = $_POST['operation'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des entrées
    if (!isBinary($a_bin) || !isBinary($b_bin)) {
        $error = 'Veuillez entrer deux nombres binaires valides (uniquement 0 et 1).';
    } elseif ($op === 'div' && bindec($b_bin) === 0) {
        $error = 'Division par zéro impossible.';
    } else {
        // Conversion en décimal
        $a = bindec($a_bin);
        $b = bindec($b_bin);

        // Calcul selon l’opération choisie
        switch ($op) {
            case 'add':
                $r = $a + $b;
                $result = decbin($r);
                break;
            case 'sub':
                $r = $a - $b;
                // Si résultat négatif, on le traite ici comme un entier signé à deux compléments
                if ($r >= 0) {
                    $result = decbin($r);
                } else {
                    // Exemple : sur 8 bits
                    $bits = 8;
                    $result = substr(decbin($r & ((1 << $bits) - 1)), -$bits);
                }
                break;
            case 'mul':
                $r = $a * $b;
                $result = decbin($r);
                break;
            case 'div':
                // Division entière + reste
                $quot = intdiv($a, $b);
                $rem  = $a % $b;
                $result = decbin($quot) . ' (quotient)';
                if ($rem !== 0) {
                    $result .= ' ; reste = ' . decbin($rem);
                }
                break;
            case 'and':
                $r = $a & $b;
                $result = decbin($r);
                break;
            case 'or':
                $r = $a | $b;
                $result = decbin($r);
                break;
            case 'xor':
                $r = $a ^ $b;
                $result = decbin($r);
                break;
            default:
                $error = 'Opération non reconnue.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calculatrice binaire</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        .error { color: red; }
        .result { margin-top: 1em; font-weight: bold; }
        fieldset { padding: 1em; }
        input[type="text"] { width: 100%; padding: .5em; font-size: 1em; }
        select, button { padding: .5em; font-size: 1em; }
    </style>
</head>
<body>
    <h1>Calculatrice binaire</h1>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <fieldset>
            <legend>Entrez deux nombres binaires</legend>
            <label for="a_bin">Nombre A (binaire) :</label><br>
            <input type="text" id="a_bin" name="a_bin" value="<?= htmlspecialchars($a_bin) ?>"><br><br>

            <label for="b_bin">Nombre B (binaire) :</label><br>
            <input type="text" id="b_bin" name="b_bin" value="<?= htmlspecialchars($b_bin) ?>"><br><br>

            <label for="operation">Opération :</label><br>
            <select id="operation" name="operation">
                <option value="add" <?= $op==='add'?'selected':'' ?>>Addition (+)</option>
                <option value="sub" <?= $op==='sub'?'selected':'' ?>>Soustraction (−)</option>
                <option value="mul" <?= $op==='mul'?'selected':'' ?>>Multiplication (×)</option>
                <option value="div" <?= $op==='div'?'selected':'' ?>>Division (÷)</option>
                <option value="and" <?= $op==='and'?'selected':'' ?>>ET bit à bit (AND)</option>
                <option value="or"  <?= $op==='or' ?'selected':'' ?>>OU bit à bit (OR)</option>
                <option value="xor" <?= $op==='xor'?'selected':'' ?>>XOR bit à bit</option>
            </select><br><br>

            <button type="submit">Calculer</button>
        </fieldset>
    </form>

    <?php if ($result !== ''): ?>
        <p class="result">Résultat (binaire) : <?= htmlspecialchars($result) ?></p>
    <?php endif; ?>
</body>
</html>
