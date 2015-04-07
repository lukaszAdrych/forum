<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-06 22:51:22
         compiled from "./Widoki/templates/strona_glowna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38621449455228e63d3aa82-40465986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07e77b68931d421338ef5fc53d4c9ffc59dc5399' => 
    array (
      0 => './Widoki/templates/strona_glowna.tpl',
      1 => 1428353476,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38621449455228e63d3aa82-40465986',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55228e63e2a3d6_69825950',
  'variables' => 
  array (
    'tematy' => 0,
    'temat' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55228e63e2a3d6_69825950')) {function content_55228e63e2a3d6_69825950($_smarty_tpl) {?>


        <table cellpadding="0" cellspacing="0" class="brd">
		<tr><td class="m"><h2>Tematy na forum</h2></td></tr>
      <?php  $_smarty_tpl->tpl_vars['temat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['temat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tematy']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['temat']->key => $_smarty_tpl->tpl_vars['temat']->value) {
$_smarty_tpl->tpl_vars['temat']->_loop = true;
?>
       
         
		<tr><td><div class="linki">
		<a href="/temat/<?php echo $_smarty_tpl->tpl_vars['temat']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['temat']->value->getNazwa();?>
</a>
		</div>
		</td></tr>
	
      <?php } ?>
      </table>
<h2>Dodaj nowy wątek</h2>
<div>
    <form method="post">
        <input type="text" name="nazwa_tematu" style="width: 500px;">
        <input class="button" type="submit" style="color: black;" value="Dodaj nowy temat">
    </form>
</div><?php }} ?>
