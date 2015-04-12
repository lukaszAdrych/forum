


        <table cellpadding="0" cellspacing="0" class="brd">
		<tr><td class="m"><h2>Tematy na forum</h2></td></tr>
      {foreach from=$tematy item=temat}
       
         
		<tr><td><div class="linki">
		<a href="/temat/{$temat->getId()}">{$temat->getNazwa()}</a>
                {if $czy_mod eq 'moderator'}
                <form method="post">
                    <select name="status_temat">
                        <option value="aktywny" {if $temat->getStatus() eq 'aktywny'}selected{/if}>Aktywny</option>
                        <option value="ukryty" {if $temat->getStatus() eq 'ukryty'}selected{/if}>Ukryty</option>
                    </select>
                    <input type="hidden" value="{$temat->getId()}" name="id_topic">
                    <input type="submit" value="Zapisz">
                </form>
                {/if}
		</div>
		</td></tr>
	
      {/foreach}
      </table>
<h2>Dodaj nowy wątek</h2>
<div>
    {if $zalogowany}
    <form method="post">
        <input type="text" name="nazwa_tematu" style="width: 500px;">
        <input class="button" type="submit" style="color: black;" value="Dodaj nowy temat">
    </form>
    {else}
        <p>Aby dodawać nowe tematy musisz się zalogować</p>
    {/if}
</div>
<div>
    <table cellpadding="0" cellspacing="0" class="posty">
             <tr><td class="m">Dane o portalu: </td></tr>
      
            <tr><td><div class="linki">
                        Ilość postów: {$portal->getIlosc_postow()}<br>
                Ilość tematów: {$portal->getIlosc_tematow()}<br>
                Ilość użytkowników: {$portal->getIlosc_uzytkownikow()}
            </div>
            </td></tr>
        </table>
</div>