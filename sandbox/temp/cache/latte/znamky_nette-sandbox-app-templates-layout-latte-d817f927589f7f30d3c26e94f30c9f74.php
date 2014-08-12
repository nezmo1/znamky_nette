<?php
// source: D:\xampp\htdocs\znamky_nette\sandbox\app/templates/@layout.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3810401183', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb9c5fd05fd2_scripts')) { function _lb9c5fd05fd2_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/rounded-corners.js"></script>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Přehled známek</title>
<meta name="keywords" content="">
<meta name="description" content="">


<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/styl1.css" rel="stylesheet" type="text/css">
<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/twigrid.datagrid.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/grid.css">
<link rel="stylesheet" media="screen" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/style.css">
<link rel="stylesheet" media="screen" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/example.css">
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/menu.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/table.css" type="text/css" media="screen">
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery-ui.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/grid.js"></script> 
<link rel="icon" type="image/ico" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">


</head>
<body>

<div id="hlavicka">
 <div id="logo">
 <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/design/logo2.png" title="Elektronická žákovská knížka"></div>
 <div id="login">
<?php if (!$user->isLoggedIn()) { Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["signInForm"], array()) ?>
      <h1>Přihlášení</h1> 
      <table>
      <tr>
        <td>
        <?php if ($form->hasErrors()) { ?><img src='<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_QUOTES) ?>
/images/owl_incorrect.png' width="140px" height="140px" alt='Tudy cesta nevede'><?php } ?>

         <?php if (!$form->hasErrors()) { ?><img src='<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_QUOTES) ?>
/images/owl_notebook.png' width="140px" height="140px" alt='Jen dva údaje tě dělí od přihlášení'><?php } ?>

        
        </td>  
       
          
         <td><input class='login-input'<?php $_input = $_form["username"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></input>
       <input class='login-input'<?php $_input = $_form["password"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></input>
       <input<?php $_input = $_form["remember"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->attributes() ?>><label>Zůstat přihlášen</label></input>
        <input class='login-submit'<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></input>   
      
      </td>
      </tr>
       </table>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ;} if ($user->isLoggedIn()) { Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["signOutForm"], array()) ?>
         
      <table>
          
      <tr>
          
        <td rowspan="2">
<?php if ($user->isInRole('4')) { ?>
        <img src='<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_QUOTES) ?>/images/lux.png' width="140px" height="140px" alt='Jsi nejlepší z nejlepších'>
<?php } ?>
         
<?php if ($user->isInRole('1')) { ?>
        <img src='<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_QUOTES) ?>/images/girl2.png' width="140px" height="140px" alt='Jsi nejlepší z nejlepších'>
<?php } ?>
         
<?php if ($user->isInRole('2')) { ?>
        <img src='<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_QUOTES) ?>/images/owl_rose.png' width="140px" height="140px" alt='Jsi nejlepší z nejlepších'>
<?php } if ($user->isInRole('3')) { ?>
        <img src='<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_QUOTES) ?>/images/owl_ebook.png' width="140px" height="140px" alt='Jsi nejlepší z nejlepších'>
<?php } ?>
        
        </td>  
       
<?php $_l->tmp = $_control->getComponent("informace"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render($user) ?>
           
        
      </tr>
        <tr> <td valign="bottom">
        <input type="button" value='Přehled' class='login-prehled'><input type="button" value='Nastavení' class='login-prehled'>        
        <input class='login-submit'<?php $_input = $_form["logout"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></input>
        </td></tr>  
        
           
       </table>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ;} ?>
 </div>


 
 </div>

  
  
   <ul id="menu">
  
<?php $_l->tmp = $_control->getComponent("menu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render($user) ?>
   </ul>
 <div id="telo">
<?php Latte\Macros\BlockMacros::callBlock($_b, 'content', $template->getParameters()) ?>
</div>
        
</body>
<div id="footer">
<footer>

<p> </p>
  <p><h4>Vytvořil Adam Nezmar</h4></p>
</footer>
</div>



 
        
<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>

</html>
