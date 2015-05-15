<div id="spis">
    {foreach from=$kontakty item=kontakt}
        <div class="kontakt" id="{$kontakt->getId()}">
            {$kontakt->imie} {$kontakt->nazwisko}
        </div>
    {/foreach}
    {if $zalogowany}
        <div class="link">
            <a href="/dodaj">Dodaj nowy kontakt</a>
        </div>
    {/if}
</div>
<div id="konkretny_kontakt" onkeyup="pobierzKontakt(this.value)">
<p id="kont"><h2>Pełne dane:</h2><span id="luk"></span></p>
</div>
<script src="js/ajax.js"></script>