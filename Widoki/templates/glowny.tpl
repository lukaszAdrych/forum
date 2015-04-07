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
  <title>Zadanie testowe</title>
</head>

<body>

<div id="kontener">
    <div id="logo">
        <div id='logowanie'>
            
            <table cellpadding="0" cellspacing="0" class="brd">
            <tr><td class="m">Logowanie:</td></tr>
      
            <tr><td><div class="linki">
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
                         Zły login, hasło, lub twoje konto nie jest aktywne
                     {/if}
                    
                {/if}
            </form>             
            </div>
            </td></tr>
        </table>
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
    {elseif $katalog eq "aktywacja"}
        {include file='strona_aktywacja.tpl'}
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


        