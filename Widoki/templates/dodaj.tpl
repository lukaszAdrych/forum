<h1>Dodaj nowy kontakt</h1>

<form method="post">
    <label for="imie">Imie:</label>
    <input id="imie" name="imie" type="text"><span id="imie1"></span> <br>
    <label for="nazwisko">Nazwisko:</label>
    <input id="nazwisko" name="nazwisko" type="text"><span id="nazwisko1"></span><br>
    <label for="email">Email:</label>
    <input id="email" name="email" type="text"><span id="email1"></span><br>
    <label for="nr_tel">Numer telefonu:</label>
    <input id="nr_tel" name="nr_tel" type="text"><span id="nr_tel1"></span><br>
    <label for="data">Data urodzenia:</label>
    <input id="data" name="data" type="text"><span id="data1"></span><br>
    <input id="buttonDodaj" type="submit" value="Dodaj kontakt" disabled>
</form>

{if $dodano}
    Nowy kontakt został dodany.
{/if}
<div class="link">
    <a href="/">Lista kontaktów</a>
</div>
<script src="js/walidacja.js"></script>