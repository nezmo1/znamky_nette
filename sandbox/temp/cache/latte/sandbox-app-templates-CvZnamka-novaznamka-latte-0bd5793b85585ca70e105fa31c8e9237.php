<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/CvZnamka/novaznamka.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7446438570', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb88469b2eb9_content')) { function _lb88469b2eb9_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> 
<?php if ($uspech=="ano") { ?><h3>Známky byly úspěšně vloženy do databáze</h3><?php } ?>

<div class='datagrid' style='width:100%;'>
<table>
    <thead><tr ><th colspan='2' style='font-size:20px; text-align: center'>Hromadné přidání čtvrtletní klasifikace</th></tr></thead>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["novaZnamka"], array()) ?>
       <tbody> 
           <tr class='alt' style='height:40px;'><td style="width:250px;"><label>Třída:</label></td><td><select style='height:40px;font-size:14px;background:#97C7F4;color:black' class='udaje' onchange="location.href='novaznamka?tridac=' + this.options[this.selectedIndex].value "<?php $_input = $_form["trida"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
  'onchange' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select></td></tr>    
<?php if ($trida_p!='n') { ?>
             <tr><td><label>Předmět nebo skupina:</label></td><td><select style='height:40px;font-size:14px;background:#97C7F4;color:black' class='udaje' <?php $_input = $_form["predmet"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select></td></tr>    
              
         
               <tr><td><label>Čtvrtletí:</label></td><td><select style='height:40px;font-size:14px;background:#97C7F4;color:black' class='udaje' <?php $_input = $_form["ctvrtleti"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select></td></tr> 
               
                <tr><td colspan='2' style='text-align:center;'><input  class='uvazek-send' style='width:300px;height:40px'<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
  'style' => NULL,
))->attributes() ?>></td></tr>
<?php } ?>
           
          
       </tbody>  
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
</table>   
   </div> 

 <br>
<?php $_l->tmp = $_control->getComponent("viteze"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render(11) ?>
   
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