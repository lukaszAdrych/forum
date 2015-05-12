<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="{$style}" type="text/css" />
    <title>Przeglądarka kontktów</title>
</head>

<body>
<div id="top">
    <div id="naglowek"><h1>Spis kontaktów</h1></div>
    <div id="logowanie">
        <form method="post">
            {if $zalogowany}
                Witaj <b>{$user}</b>
                <form method="post">
                    <input type="hidden" name="wyloguj" value="tak">
                    <input class="button" type="submit" value="Wyloguj">
                </form>
            {else}
                Login: <input style="margin-bottom: 4px;" type="text" name="nick">
                Hasło: <input style="margin-bottom: 4px;" type="password" name="haslo">
                <input class="button" type="submit" style="color: black; left: 40px;" value="Zaloguj">
                {if $czy_blad}
                    Zły login lub hasło.
                {/if}

            {/if}
        </form>
    </div>
    <div id="tresc">Treść strony</div>
    <div id="stopka">Stopka serwisu</div>
</div>
</body>

</html>