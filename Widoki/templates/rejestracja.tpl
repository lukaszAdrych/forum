
<div id="panel">
    <form method="post">
<label for="login">Login:</label>
<input type="text" id="login" name="nickRej">
<label for="mejl">E-mail:</label>
<input type="text" id="mejl" name="email">
<label for="haslo1">Hasło:</label>
<input type="password" id="haslo1" name="haslo1">
<label for="haslo2">Powtórz hasło:</label>
<input type="password" id="haslo2" name="haslo2">
<div id="lower">
<input type="submit" class="button" value="Rejestruj" />
{if $czy_blad_rej}
    Błąd podczas rejestracji, spróbuj ponownie.
{/if}
</div>
</form>
</div>