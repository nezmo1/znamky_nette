<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/Znamka/vygenFormNovaZnamka.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6072682265', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb466c6651a9_content')) { function _lb466c6651a9_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["formHromadnaZnamka"], array()) ?>
        <div class='datagrid' style='width:80%; margin-left:10%'>
<table class="yolo">

    <thead><tr ><th colspan='2' style='font-size:18px; text-align: center'>Hromadná známka</th></tr></thead>
       <tr style='background:#F8FF8E'><th style='font-size:16px; text-align: center'>Žák</th><th style='font-size:16px; text-align: center'>Známka</th></tr>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($vyber_zaku) as $vyber_zak) { ?>
        <tr <?php if ($iterator->odd) { ?>class='alt'<?php } ?>><td style='padding-left:20px;'><input style='height:25px;font-size:14px;width:350px;padding-left:20px;background:#97C7F4;font-weight: bold' class='udaje'<?php $_input = $_form["zak_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
))->attributes() ?>></td>
          
            
<?php if ($sirka==FALSE) { ?>
            <td>  <input style='height:25px;font-size:14px;width:350px;padding-left:20px; font-weight: bold; color: red;font-size: 18px; text-align: center;'  class='udaje' id="znamka_<?php echo Latte\Runtime\Filters::escapeHtml($pom_cislo, ENT_COMPAT) ?>
"<?php $_input = $_form["znamka_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
  'id' => NULL,
))->attributes() ?>>
<?php if ($desktop==TRUE) { ?>
           <br> 
           <a  style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','1');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/1.png" width="35px" height="35px" alt="1"></a> 
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','2');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/2.png" width="35px" height="35px" alt="2"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','3');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/3.png" width="35px" height="35px" alt="3"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','4');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/4.png" width="35px" height="35px" alt="4"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','5');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/5.png" width="35px" height="35px" alt="5"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','-');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/minus.png" width="35px" height="35px" alt="-"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','*');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/hvezda.png" width="35px" height="35px" alt="*"></a>
<?php } ?>
           </td></tr>  
<?php } ?>
        
<?php if ($sirka!=FALSE) { ?>
           
            <td><textarea style='height:150px;font-size:14px;width:350px;padding-left:20px;font-weight: bold; color: red;font-size: 18px;text-align: center;'  class='udaje' <?php $_input = $_form["znamka_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea> 
        
<?php if ($desktop==TRUE) { ?>
           <br> 
       <a  style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','1');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/1.png" width="35px" height="35px" alt="1"></a> 
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','2');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/2.png" width="35px" height="35px" alt="2"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','3');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/3.png" width="35px" height="35px" alt="3"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','4');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/4.png" width="35px" height="35px" alt="4"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','5');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/5.png" width="35px" height="35px" alt="5"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','-');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/minus.png" width="35px" height="35px" alt="-"></a>
            <a style="cursor: pointer;" onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>
','*');"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/hvezda.png" width="35px" height="35px" alt="*"></a>
<?php } ?>
       
       </td></tr> 
<?php } ?>
        
        
        
        <?php $pom_cislo=$pom_cislo+1 ;$iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
        <?php $pom_cislo=1 ;$iterations = 0; foreach ($vyber_zaku as $vyber_zak) { ?>
           <input value='<?php echo Latte\Runtime\Filters::escapeHtml($vyber_zak['zak'], ENT_QUOTES) ?>
'<?php $_input = $_form["hzak_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'value' => NULL,
))->attributes() ?>> 
           <?php $pom_cislo=$pom_cislo+1 ;$iterations++; } ?>
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
    
    </table> 


   </div> 


<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>


    
<script>
function myFunction(zak,znamka) {
    document.getElementById(zak).value = document.getElementById(zak).value + znamka;
}
</script>



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