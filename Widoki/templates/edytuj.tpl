<h1>Edytuj obecny kontakt</h1>

<form method="post">
    <label for="imie">Imie:</label>
    <input id="imie" name="imie" type="text" value="{$kontakt->getImie()}"><span id="imie1"></span><br>
    <label for="nazwisko">Nazwisko:</label>
    <input id="nazwisko" name="nazwisko" type="text" value="{$kontakt->getNazwisko()}"><span id="nazwisko1"></span><br>
    <label for="email">Email:</label>
    <input id="email" name="email" type="text" value="{$kontakt->getEmail()}"><span id="email1"></span><br>
    <label for="nr_tel">Numer telefonu:</label>
    <input id="nr_tel" name="nr_tel" type="text" value="{$kontakt->getTelefon()}"><span id="nr_tel1"></span><br>
    <label for="data">Data urodzenia:</label>
    <input id="data" name="data" type="text" value="{$kontakt->getDataUrodzenia()}"><span id="data1"></span><br>
    <input id="buttonEdytuj" type="submit" value="Edytuj kontakt" disabled>
</form>

<div class="link">
    <a href="/">Lista kontaktów</a>
</div>
<script src="../js/walidacja.js"></script>