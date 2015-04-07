<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-06 15:49:12
         compiled from "./Widoki/templates/rejestracja.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124603206055228ed8924a67-35058857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '574a40b232a5781276ecf9e11620eef6cf69a729' => 
    array (
      0 => './Widoki/templates/rejestracja.tpl',
      1 => 1428243233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124603206055228ed8924a67-35058857',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55228ed8997981_28915026',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55228ed8997981_28915026')) {function content_55228ed8997981_28915026($_smarty_tpl) {?><form method="post">
<div class="box">
<h1>Rejestracja :</h1>
<label>
<span>Nick</span>
<input type="text" class="wpis" name="nick" id="nazwa"/>
</label><br>
<label>
<span>E-mail :</span>
<input type="text" class="wpis" name="email" id="email"/>
</label><br>
<label>
<span>Hasło :</span>
<input type="text" class="wpis" name="haslo1" id="temat"/>
</label><br>
<label>
<span>Powtórz hasło :</span>
<input type="text" class="wpis" name="haslo2" id="temat"/><br>
<input type="submit" class="button" value="Rejestruj" />
</label><br>
</div>
</form><?php }} ?>
