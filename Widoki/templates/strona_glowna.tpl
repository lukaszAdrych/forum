
<h2>Tematy na forum</h2>
      {foreach from=$tematy item=temat}
          <div class="temat">
              {$temat->getNazwa()}<br>
              <a href="/temat/{$temat->getId()}">{$temat->getNazwa()}</a>
          </div>
      {/foreach}
<h2>Dodaj nowy wątek</h2>
<div>
    <form method="post">
        <input type="text" name="nazwa_tematu">
            <input type="submit" style="color: black;">
    </form>
</div>