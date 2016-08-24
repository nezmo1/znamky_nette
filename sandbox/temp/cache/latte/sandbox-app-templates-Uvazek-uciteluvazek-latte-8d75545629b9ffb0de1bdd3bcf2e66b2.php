<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/Uvazek/uciteluvazek.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1933046604', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbc637b7ef76_content')) { function _lbc637b7ef76_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><script>
$(document).ready(function(){
 $('input').keyup(function(e){
   if(e.which==40)
   $(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
  else if(e.which==38)
   $(this).closest('tr').prev().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
 });
});
</script>

<div class="right_col" role="main">
         
          
           
           
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
                  
                  <div class="x_content" >
                      
                      
<?php call_user_func(reset($_b->blocks['jmeno']), $_b, get_defined_vars()) ; if ($pocet_skupin->pocet!=0) { ?>
<br>
<h4>Skupiny</h4>
<p>Tento učitel má definovány vyučované skupiny žáků. Bude moci přidávat známky všem žákům ve skupině.</p>

    <table class="table table-striped"><thead><tr><th>Název skupiny</th><th style='text-align: center;'>Předmět</th><th style='text-align: center;'>Třída</th></tr></thead>
    <tbody>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($skupiny) as $skupina) { ?>
    <tr <?php if ($iterator->odd) { ?>class='alt'<?php } ?>><td><b><?php echo Latte\Runtime\Filters::escapeHtml($skupina->nazev_skupiny, ENT_NOQUOTES) ?>
</b></td><td style='text-align: center;'><?php echo Latte\Runtime\Filters::escapeHtml($skupina->nazev_predmetu, ENT_NOQUOTES) ?>
</td><td style='text-align: center;'><?php echo Latte\Runtime\Filters::escapeHtml($skupina->jmeno_tridy, ENT_NOQUOTES) ?>.</td></tr>
    
<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
    </tbody>
    </table>

<br><br>
<?php } ?>
<h4>Vyučované předměty</h4>

<table class='table table-striped'>
    <thead><tr ><th>Předmět</th><th style=' text-align: center' colspan='<?php echo Latte\Runtime\Filters::escapeHtml($tridypocet->pocet, ENT_QUOTES) ?>'>Třídy</th></tr></thead>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["defUvazek"], array()) ;$iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($predmety) as $predmet) { ?>
     <tr <?php if ($iterator->odd) { ?>class='alt'<?php } ?>>
     <td><b><?php echo Latte\Runtime\Filters::escapeHtml($predmet->nazev, ENT_NOQUOTES) ?></b></td>
<?php $iterations = 0; foreach ($tridy->fetchAll() as $trida) { ?>
    
     <td style='min-width:40px; text-align: center;<?php if ((in_array($trida->id_tridy."_".$predmet->id_predmetu,$uvazekmajiny))) { ?>
background-color:#00BFFF;<?php } ?> <?php if ((in_array($ucitel->id_users."_".$trida->id_tridy."_".$predmet->id_predmetu,$uvazekma) and ($_GET['ucitelId']==$ucitel->id_users))) { ?>
background-color:lime;<?php } if (in_array($trida->id_tridy.'_'.$predmet->id_predmetu,$discheck)) { ?>
background-color:yellow;<?php } ?>'>
         <abbr title='<?php echo "Předmět vyučuje:"; echo "\n" ;$iterations = 0; foreach ($uvazekuci->fetchAll() as $uvazeku) { if ($trida->id_tridy==$uvazeku->trida and $predmet->id_predmetu==$uvazeku->predmet) { echo Latte\Runtime\Filters::escapeHtml($uvazeku->jmeno, ENT_QUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($uvazeku->prijmeni, ENT_QUOTES) ;echo "\n"; } $iterations++; } ?>'>
         <?php echo Latte\Runtime\Filters::escapeHtml($trida->jmeno_tridy, ENT_NOQUOTES) ?>
<br><input <?php if ((in_array($ucitel->id_users."_".$trida->id_tridy."_".$predmet->id_predmetu,$uvazekma) and ($_GET['ucitelId']==$ucitel->id_users))) { ?>
 checked="checked" <?php } if (in_array($trida->id_tridy.'_'.$predmet->id_predmetu,$discheck)) { ?>
onclick="return false" checked='checked'<?php } $_input = $_form["n_{$pom_check}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'checked' => NULL,
  'onclick' => NULL,
))->attributes() ?>>
     <input value="<?php echo Latte\Runtime\Filters::escapeHtml($ucitel->id_users, ENT_COMPAT) ?>
_<?php echo Latte\Runtime\Filters::escapeHtml($trida->id_tridy, ENT_COMPAT) ?>_<?php echo Latte\Runtime\Filters::escapeHtml($predmet->id_predmetu, ENT_COMPAT) ?>
"<?php $_input = $_form["h_{$pom_check}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'value' => NULL,
))->attributes() ?>>
     </abbr>
     </td>
     
     <?php $pom_check++ ;$iterations++; } ?>
     </tr>       
<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
     
    <tr ><td colspan='<?php echo Latte\Runtime\Filters::escapeHtml($tridypocet->pocet, ENT_QUOTES) ?>' style='text-align:center;' >
           
            
            
      <input class="btn btn-success"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><input  class='btn btn-info'<?php $_input = $_form["zpet"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>>
        </td></tr>
    
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
    <tr><td colspan='<?php echo Latte\Runtime\Filters::escapeHtml($tridypocet->pocet, ENT_QUOTES) ?>' style='color:red; text-align:center; background:yellow; font-weight: bold'>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>
    <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
" style='<?php if ($flash->message=='Předměty byly definovány.') { ?> color:green <?php } ?>
'><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
        </td>
    
    </tr>
    
</table>   
  

                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  

                  </div>
                </div>
              </div>

              <div class="clearfix"></div>
                      
                      
                      
                     <!-- <?php $_l->tmp = $_control->getComponent("viteze"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render(10) ?>-->
                      
                    <br>
                    

    
<script>
function myFunction(zak,znamka) {
    document.getElementById(zak).value = document.getElementById(zak).value + znamka;
}

 function zpetNaSeznam(){
            window.location = <?php echo Latte\Runtime\Filters::escapeJs($basePath) ?> + "/uvazek/seznamucitelu";
        }
</script>


</div>
                    
                    </div>
                  </div>
                </div>
            </div>



   










<?php
}}

//
// block jmeno
//
if (!function_exists($_b->blocks['jmeno'][] = '_lb1c04d02b37_jmeno')) { function _lb1c04d02b37_jmeno($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>                  <h3><?php echo Latte\Runtime\Filters::escapeHtml($ucitel->titul, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($ucitel->jmeno, ENT_NOQUOTES) ?> <?php echo Latte\Runtime\Filters::escapeHtml($ucitel->prijmeni, ENT_NOQUOTES) ?> <br><small>Definice úvazku</small></h3>
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