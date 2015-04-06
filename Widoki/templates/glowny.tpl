<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
  <meta http-equiv="Content-Language" content="pl" />
  <meta name="Keywords" content="słowa, kluczowe, oddzielone, przecinkami" />
  <meta name="Description" content="krótki opis zawartości strony" />
  <meta name="Robots" content="ALL" />
  <meta name="Author" content="flankerds.com" />
  <link rel="stylesheet" href="{$style}" type="text/css" />
  <title>Szablonik flankerds.com</title>
</head>

<body>

<div id="kontener">
    <div id="logo">
        <div id='logowanie'>
            <form method="post">
                {if $zalogowany}
                Witaj {$user}
                <form method="post">
                    <input type="hidden" name="wyloguj" value="tak">
                    <input type="submit" value="Wyloguj">
                </form>
                {else}
                    Login: <input type="text" name="nick">
                Hasło: <input type="password" name="haslo">
                <input type="submit" style="color: black;">
                    
                {/if}
            </form>
        </div>
    </div>
<div id="menu">
 <a href="/">Strona Główna</a>
 <a href="/konto">Moje konto</a>
 <a href="/rejestracja">Rejestracja</a>
</div>
<div id="tresc">
    {if $katalog eq ""}
        {include file='strona_glowna.tpl'}
    {elseif $katalog eq "rejestracja"}
        {include file='rejestracja.tpl'}
    {elseif $katalog eq "temat"}
        {include file='strona_temat.tpl'}
    {elseif $katalog eq "konto"}
        {include file='strona_konto.tpl'}
    {else}
        <h1>STRONA BLEDU!!!!</h1>
    {/if}
</div>
</div>

<div id="stopka">
<div id="copyright">Copyright by Ty</div>
<div id="design">Design by <a href="http://www.flankerds.com" target="_blank">flankerds.com</a></div>
</div>    
</body>
</html>