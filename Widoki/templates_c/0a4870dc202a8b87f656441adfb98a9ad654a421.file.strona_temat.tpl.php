<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-06 22:42:44
         compiled from "./Widoki/templates/strona_temat.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169271423055228f2abbab00-26987606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a4870dc202a8b87f656441adfb98a9ad654a421' => 
    array (
      0 => './Widoki/templates/strona_temat.tpl',
      1 => 1428352951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169271423055228f2abbab00-26987606',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55228f2ac364f0_39271061',
  'variables' => 
  array (
    'posty' => 0,
    'post' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55228f2ac364f0_39271061')) {function content_55228f2ac364f0_39271061($_smarty_tpl) {?><h2>Posty w tym dziale</h2>
      <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posty']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
         <table cellpadding="0" cellspacing="0" class="posty">
            <tr><td class="m"><?php echo $_smarty_tpl->tpl_vars['post']->value->getData();?>
 </td></tr>
      
            <tr><td><div class="linki">
               <?php echo $_smarty_tpl->tpl_vars['post']->value->getTresc();?>
  
            </div>
            </td></tr>
        </table>
      <?php } ?>
<h2>Dodaj nowy post</h2>
<div>
    <form method="post">
        <textarea name="tresc_postu" cols="97" rows="5" style="margin-bottom: 5px">Twoja odpowiedź...</textarea>
        <input class="button" type="submit" style="color: black; float: right;" value="Wyślij post">
    </form>
</div><?php }} ?>
