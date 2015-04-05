<h2>Posty w tym dziale</h2>
      {foreach from=$posty item=post}
          <div class="temat">
              {$post->getTresc()}<br>
              
          </div>
      {/foreach}
<h2>Dodaj nowy post</h2>
<div>
    <form method="post">
        <input type="text" name="tresc_postu">
            <input type="submit" style="color: black;">
    </form>
</div>