<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/Skupiny/skupinadef.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8950553896', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb577d79106a_content')) { function _lb577d79106a_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h3><?php echo Latte\Runtime\Filters::escapeHtml($skupina->nazev_skupiny, ENT_NOQUOTES) ?></h3>

<div style="float:left"><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Skupiny:seznamskupindef"), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/go_back.png" width="7%" alt="Zpět na seznam" title="Zpět na seznam"></a></div>
<div class='datagrid' style='width:40%; float:left'>
<table>
    <thead><tr ><th colspan='2' style='font-size:18px; text-align: center'>Žáci ve třídě</th></tr></thead>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["seznamZakuSkupina"], array()) ;$iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($zaci_v_ts) as $zaci_v_t) { ?>
     <tr <?php if ($iterator->odd) { ?>class='alt'<?php } ?>><td><b><?php echo Latte\Runtime\Filters::escapeHtml($zaci_v_t->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($zaci_v_t->jmeno, ENT_NOQUOTES) ?> </b></td>
     <td><input<?php $_input = $_form["n_{$pom_check}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->attributes() ?>
>  <input value="<?php echo Latte\Runtime\Filters::escapeHtml($zaci_v_t->id_users, ENT_COMPAT) ?>
"<?php $_input = $_form["h_{$pom_check}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'value' => NULL,
))->attributes() ?>></td>
     
     
     </tr>   
     <?php $pom_check++; $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
     <tr><td colspan="2" style="text-align:center;"><input class="uvazek-send"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></td></tr>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
    <tr><td colspan='2' style='color:red; text-align:center; background:yellow; font-weight: bold'>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>
    <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
" style='<?php if ($flash->message=='Operace proběhla úspěšně') { ?> color:green <?php } ?>
'><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
        </td>
    
    </tr>
    
</table>   
   </div> 

<div class="sipka" style="float:left; padding-top:20%;padding-left:5%;"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/arrows.png" width="100px" height="100px"></div>

<div class='datagrid' style='width:40%; float:right'>
<table>
    <thead><tr ><th colspan='2' style='font-size:18px; text-align: center'>Žáci ve skupině</th></tr></thead>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["seznamZakuVeSkupine"], array()) ;$iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($zaci_v_sks) as $zaci_v_sk) { ?>
     <tr <?php if ($iterator->odd) { ?>class='alt'<?php } ?>><td><b><?php echo Latte\Runtime\Filters::escapeHtml($zaci_v_sk->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($zaci_v_sk->jmeno, ENT_NOQUOTES) ?> </b></td>
     <td><input<?php $_input = $_form["n1_{$pom_check2}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->attributes() ?>
>  <input value="<?php echo Latte\Runtime\Filters::escapeHtml($zaci_v_sk->id_users, ENT_COMPAT) ?>
"<?php $_input = $_form["h1_{$pom_check2}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'value' => NULL,
))->attributes() ?>></td>
     
     
     </tr>   
     <?php $pom_check2++; $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
     <tr><td colspan="2" style="text-align:center;"><input class="uvazek-send"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></td></tr>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
    <tr><td colspan='2' style='color:red; text-align:center; background:yellow; font-weight: bold'>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>
    <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
" style='<?php if ($flash->message=='Operace proběhla úspěšně') { ?> color:green <?php } ?>
'><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
        </td>
    
    </tr>
    
</table>   
   </div> 





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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 