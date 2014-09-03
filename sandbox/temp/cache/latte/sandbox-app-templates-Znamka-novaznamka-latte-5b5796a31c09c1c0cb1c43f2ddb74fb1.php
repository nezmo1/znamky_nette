<?php
// source: D:\xampp\htdocs\znamky_nette\sandbox\app/templates/Znamka/novaznamka.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3650736461', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbd62be796be_content')) { function _lbd62be796be_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

<div class='datagrid' style='width:100%;'>
<table>
    <thead><tr ><th colspan='2' style='font-size:18px; text-align: center'>Nová známka</th></tr></thead>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["novaZnamka"], array()) ?>
       <tbody> 
           <tr><td style="width:250px;"><label>Třída:</label></td><td><select class='udaje' onchange="location.href='novaznamka?tridac=' + this.options[this.selectedIndex].value "<?php $_input = $_form["trida"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
  'onchange' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select></td></tr>    
<?php if ($trida_p!='n') { ?>
             <tr><td><label>Předmět nebo skupina:</label></td><td><select class='udaje' <?php $_input = $_form["predmet"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select></td></tr>    
              <tr><td><label>Popis:</label></td><td><input class='udaje'<?php $_input = $_form["popis"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></td></tr>  
               <tr><td><label>Váha známky:</label></td><td><select class='udaje' <?php $_input = $_form["vaha"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select></td></tr> 
              <tr><td><label>Datum:</label></td><td><input id="datepicker" class='udaje'<?php $_input = $_form["datum"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'id' => NULL,
  'class' => NULL,
))->attributes() ?>></td></tr> 
               
                <tr><td><label>Datum:</label></td><td><input  class='login-submit'<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></td></tr>
<?php } ?>
       </tbody>  
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 