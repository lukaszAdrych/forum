<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-06 16:14:58
         compiled from "./Widoki/templates/strona_konto.tpl" */ ?>
<?php /*%%SmartyHeaderCode:496196938552294e21817e6-50380632%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f0b6145373cf3783dbd19880c1f1819f5280839' => 
    array (
      0 => './Widoki/templates/strona_konto.tpl',
      1 => 1428329542,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '496196938552294e21817e6-50380632',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_552294e21b1c40_63464190',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_552294e21b1c40_63464190')) {function content_552294e21b1c40_63464190($_smarty_tpl) {?>Zmień hasło:

<form>
    Stara hasło:<input type="password" name="stare_haslo">
    Nowe hasło:<input type="password" name="nowe_haslo1">
    Powtórz nowe hasło:<input type="password" name="nowe_haslo2">
    <input type="submit" value="Zapisz">
</form><?php }} ?>
