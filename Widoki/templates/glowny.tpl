<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
  <meta http-equiv="Content-Language" content="pl" />
  <meta name="Keywords" content="słowa, kluczowe, oddzielone, przecinkami" />
  <meta name="Description" content="krótki opis zawartości strony" />
  <meta name="Robots" content="ALL" />
  <meta name="Author" content="flankerds.com" />
  <link rel="stylesheet" href="style.css" type="text/css" />
  <title>Szablonik flankerds.com</title>
</head>

<body>

<div id="kontener">
<div id="logo"></div>
<div id="menu">
 <a href="/">Strona Główna</a>
 <a href="/konto">Moje konto</a>
 <a href="/rejestracja">Jajko</a>
</div>
<div id="tresc">
<h2>Tematy na forum</h2>
      {foreach from=$tematy item=temat}
          <div class="temat">
              {$temat->getNazwa()}
          </div>
      {/foreach}
<h2>Dodaj nowy wątek</h2>
       </div>
</div>

<div id="stopka">
<div id="copyright">Copyright by Ty</div>
<div id="design">Design by <a href="http://www.flankerds.com" target="_blank">flankerds.com</a></div>
</div>    
</body>
</html>