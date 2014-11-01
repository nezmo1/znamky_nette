<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/CvZnamka/vygenFormNovaZnamka.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0100920524', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb7b9751fc66_content')) { function _lb7b9751fc66_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class='datagrid' style='width:80%; margin-left:10%'>
<table class="yolo" onKeyPress="javascript:check">

    <thead><tr ><th colspan='2' style='font-size:18px; text-align: center'>Hromadná čtvrtletní klasifikace</th></tr></thead>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["formHromadnaZnamka"], array()) ?>
       <tr style='background:#F8FF8E'><th style='font-size:16px; text-align: center'>Žák</th><th style='font-size:16px; text-align: center'>Známka</th></tr>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($vyber_zaku) as $vyber_zak) { ?>
        <tr <?php if ($iterator->odd) { ?>class='alt'<?php } ?>><td tabindex='100<?php echo Latte\Runtime\Filters::escapeHtml($pom_cislo, ENT_QUOTES) ?>
' style='padding-left:20px;'><input style='height:25px;font-size:14px;width:350px;padding-left:20px;background:#97C7F4;font-weight: bold' class='udaje'<?php $_input = $_form["zak_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
))->attributes() ?>></td>
          
            
<?php if ($sirka==FALSE) { ?>
            <td tabindex='<?php echo Latte\Runtime\Filters::escapeHtml($pom_cislo, ENT_QUOTES) ?>
'>  <input style='height:25px;font-size:14px;width:350px;padding-left:20px;' class='udaje'<?php $_input = $_form["znamka_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
))->attributes() ?>></td></tr>  
<?php } ?>
        
<?php if ($sirka!=FALSE) { ?>
            <td tabindex='<?php echo Latte\Runtime\Filters::escapeHtml($pom_cislo, ENT_QUOTES) ?>
'><textarea style='height:150px;font-size:14px;width:350px;padding-left:20px;' class='udaje' <?php $_input = $_form["znamka_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea></td></tr>  
<?php } ?>
        
        <input value='<?php echo Latte\Runtime\Filters::escapeHtml($vyber_zak['zak'], ENT_QUOTES) ?>
'<?php $_input = $_form["hzak_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'value' => NULL,
))->attributes() ?>>
        
        <?php $pom_cislo=$pom_cislo+1 ;$iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
        <input value='<?php echo Latte\Runtime\Filters::escapeHtml($pom_cislo, ENT_QUOTES) ?>
'<?php $_input = $_form["pocet_zaznamu"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'value' => NULL,
))->attributes() ?>>
      <tr><td colspan='2' style='text-align:center;'><input  class='uvazek-send' style='width:300px;height:40px'<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
  'style' => NULL,
))->attributes() ?>></td></tr>
             
    <tr><td colspan='2' style='color:red; text-align:center; background:yellow; font-weight: bold'>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>
    <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
" style='<?php if ($flash->message=='Uživatel byl úspěšně přidán do databáze.') { ?>
 color:green <?php } ?>'><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
        </td>
    
    </tr>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
</table>   
<script>
    
</script>
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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 