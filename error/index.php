<?php ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Łukasz Grusiecki">
    <title>Gazetka Parafialna - Parafia Świętej Rodziny</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .try-again{
            font-family: 'Source Sans 3', sans-serif;
            color: var(--soft-cream);
            text-decoration: none;
            font-weight: 600;
            padding: 8px 14px;
            border: 1px solid var(--antique-gold);
            border-radius: 4px;
            background: rgba(255,255,255,0.05);
            transition: all 0.25s ease;
        }

        .try-again:hover{
            background: var(--antique-gold);
            color: var(--deep-olive);
            border-color: var(--antique-gold);
        }
    </style>
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <script src="error_handle.js" defer></script>
</head>
<body>
    <header>
        <h1>Wystąpił błąd</h1>
        <p>Przepraszamy, wystąpił błąd połączenia z serwerem</p>
        <a href="../" class="try-again">Spróbuj ponownie</a>
    </header>
</body>
</html>
