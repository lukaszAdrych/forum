{if $id eq $id_parametr}
<h2>Panel użytkownika - zmień hasło:</h2>
<div id="panel">
<form method="post">
    <label for="stare_has">Stare hasło:</label>
    <input type="text" id="stare_has" name="stare_haslo">
    
    <label for="nowe_has1">Nowe hasło:</label>
    <input type="password" id="nowe_has1" name="nowe_haslo1">
    <label for="nowe_has2">Powtórz hasło:</label>
    <input type="password" id="nowe_has2" name="nowe_haslo2">
    <div id="lower">
    <input class="button" type="submit" value="Zapisz">
    </div>
</form>
</div>
{/if}
<h2>Profil użytkownika:</h2>
    Ilość postów na forum: {$ilosc_postow}<br>
    Moje posty:
    {foreach from=$posty item=post}
         <table cellpadding="0" cellspacing="0" class="posty">
             <tr><td style="text-align: right" class="m">{$post->getData()} </td></tr>
      
            <tr><td colspan="2"><div class="linki">
               {$post->getTresc()}  
            </div>
            </td></tr>
        </table>
      {/foreach}

