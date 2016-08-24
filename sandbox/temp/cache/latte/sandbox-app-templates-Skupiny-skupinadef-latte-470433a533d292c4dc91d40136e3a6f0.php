<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/Skupiny/skupinadef.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9013641773', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb19b6c7e29f_content')) { function _lb19b6c7e29f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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

 <script language="javascript">
function checkMe() {
    if (confirm("Opravdu chcete smazat tuto skupinu?")) {
       
        return true;
    } else {
       
        return false;
    }
}
</script>

<div class="right_col" role="main">
         
            <div class="page-title">
              <div class="title_left">
                <h3>Seznam Skupin</h3>
              </div>

             
            </div>
           
           
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
                  
                  <div class="x_content" >
                      
                   
                      
                      
                      
                      
                      <h3><?php echo Latte\Runtime\Filters::escapeHtml($skupina->nazev_skupiny, ENT_NOQUOTES) ?></h3>


<div class="col-md-4 col-sm-12 col-xs-12">
<table class="table striped-table">
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
     <tr><td colspan="2" style="text-align:center;"><input class="btn btn-success"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
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

<div class="sipka" style="float:left; padding-top:20%;padding-left:10%;"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/arrows.png" width="100px" height="100px"></div>

<div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-2">
<table class="table striped-table">
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
     <tr><td colspan="2" style="text-align:center;"><input class="btn btn-success"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
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
                      
                  
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">

                     <input type="button" class="btn btn-info col-md-offset-5" value='Zpět na seznam skupin' onClick='zpetNaSeznam();'>

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
</script>


</div>
                    
                    </div>
                  </div>
                </div>
            </div>



   



<script>
        function zpetNaSeznam(){
            window.location = <?php echo Latte\Runtime\Filters::escapeJs($basePath) ?> + "/skupiny/seznamskupindef";
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