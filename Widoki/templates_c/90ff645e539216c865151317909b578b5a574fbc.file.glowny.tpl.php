<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-07 12:15:20
         compiled from "./Widoki/templates/glowny.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191911255655228de2983164-61079539%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90ff645e539216c865151317909b578b5a574fbc' => 
    array (
      0 => './Widoki/templates/glowny.tpl',
      1 => 1428401692,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191911255655228de2983164-61079539',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55228de29d4910_82571643',
  'variables' => 
  array (
    'style' => 0,
    'zalogowany' => 0,
    'user' => 0,
    'katalog' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55228de29d4910_82571643')) {function content_55228de29d4910_82571643($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
  <meta http-equiv="Content-Language" content="pl" />
  <meta name="Keywords" content="słowa, kluczowe, oddzielone, przecinkami" />
  <meta name="Description" content="krótki opis zawartości strony" />
  <meta name="Robots" content="ALL" />
  <meta name="Author" content="flankerds.com" />
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
" type="text/css" />
  <title>Zadanie testowe</title>
</head>

<body>

<div id="kontener">
    <div id="logo">
        <div id='logowanie'>
            
            <table cellpadding="0" cellspacing="0" class="brd">
            <tr><td class="m">Logowanie:</td></tr>
      
            <tr><td><div class="linki">
               <form method="post">
                <?php if ($_smarty_tpl->tpl_vars['zalogowany']->value) {?>
                    Witaj <b><?php echo $_smarty_tpl->tpl_vars['user']->value;?>
</b>
                <form method="post">
                    <input type="hidden" name="wyloguj" value="tak">
                        <input class="button" type="submit" value="Wyloguj">
                </form>
                <?php } else { ?>
                    Login: <input style="margin-bottom: 4px;" type="text" name="nick">
                Hasło: <input style="margin-bottom: 4px;" type="password" name="haslo">
                    <input class="button" type="submit" style="color: black; left: 40px;" value="Zaloguj">
                    
                <?php }?>
            </form>             
            </div>
            </td></tr>
        </table>
        </div>
    </div>
<div id="menu">
 <a href="/">Strona Główna</a>
 <a href="/konto">Moje konto</a>
 <a href="/rejestracja">Rejestracja</a>
</div>
<div id="tresc">
    <?php if ($_smarty_tpl->tpl_vars['katalog']->value=='') {?>
        <?php echo $_smarty_tpl->getSubTemplate ('strona_glowna.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php } elseif ($_smarty_tpl->tpl_vars['katalog']->value=="rejestracja") {?>
        <?php echo $_smarty_tpl->getSubTemplate ('rejestracja.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php } elseif ($_smarty_tpl->tpl_vars['katalog']->value=="temat") {?>
        <?php echo $_smarty_tpl->getSubTemplate ('strona_temat.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php } elseif ($_smarty_tpl->tpl_vars['katalog']->value=="konto") {?>
        <?php echo $_smarty_tpl->getSubTemplate ('strona_konto.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php } else { ?>
        <h1>STRONA BLEDU!!!!</h1>
    <?php }?>
</div>
</div>

<div id="stopka">
<div id="copyright">Copyright by Ty</div>
<div id="design">Design by <a href="http://www.flankerds.com" target="_blank">flankerds.com</a></div>
</div>    
</body>
</html>


        <?php }} ?>
