<h2>Posty w {$nazwa_tematu}</h2>
      {foreach from=$posty item=post}
         <table cellpadding="0" cellspacing="0" class="posty">
             <tr><td class="m">{$post->getUser_name()} napisał:</td><td class="m">{$post->getData()} </td></tr>
      
            <tr><td><div class="linki">
                {$post->getTresc()}<br>  
                {if $czy_mod eq 'moderator'}
                <form method="post">
                    <select name="status_post">
                        <option value="aktywny" {if $post->getStatus() eq 'aktywny'}selected{/if}>Aktywny</option>
                        <option value="ukryty" {if $post->getStatus() eq 'ukryty'}selected{/if}>Ukryty</option>
                    </select>
                    <input type="hidden" value="{$post->getId()}" name="id_post">
                    <input type="submit" value="Zapisz">
                </form>
                {/if}
            </div>
            </td></tr>
        </table>
      {/foreach}
<h2>Dodaj nowy post</h2>
<div>
    {if $zalogowany}
    <form method="post">
        <textarea name="tresc_postu" cols="97" rows="5" style="margin-bottom: 5px">Twoja odpowiedź...</textarea>
        <input class="button" type="submit" style="color: black; float: right;" value="Wyślij post">
    </form>
    {else}
        <p>Aby dodawać nowe posty musisz się zalogować</p>
    {/if}
</div>