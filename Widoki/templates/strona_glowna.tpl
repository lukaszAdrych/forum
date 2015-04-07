


        <table cellpadding="0" cellspacing="0" class="brd">
		<tr><td class="m"><h2>Tematy na forum</h2></td></tr>
      {foreach from=$tematy item=temat}
       
         
		<tr><td><div class="linki">
		<a href="/temat/{$temat->getId()}">{$temat->getNazwa()}</a>
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