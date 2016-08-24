<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/Znamka/vygenFormNovaZnamka.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7148143126', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb4679edeb79_content')) { function _lb4679edeb79_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
         
            <div class="page-title">
              <div class="title_left">
                <h3>Hromadné přidání známek</h3>
              </div>

             
            </div>
           
           
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
                  
                  <div class="x_content" >
                      
                      
                  
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo Latte\Runtime\Filters::escapeHtml($trida['jmeno_tridy'], ENT_NOQUOTES) ?>
. třída - <?php echo Latte\Runtime\Filters::escapeHtml($predmet['nazev'], ENT_NOQUOTES) ?>
 <small><?php echo Latte\Runtime\Filters::escapeHtml($popis, ENT_NOQUOTES) ?> </small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Žák</th>
                          <th>Známka</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["formHromadnaZnamka"], array()) ?>
        

    
       
<?php $iterations = 0; foreach ($vyber_zaku as $vyber_zak) { ?>
        <tr><td><input class='form-control'<?php $_input = $_form["zak_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></td>
          
            
<?php if ($sirka==FALSE) { ?>
            <td>  <input  class='form-control' id="znamka_<?php echo Latte\Runtime\Filters::escapeHtml($pom_cislo, ENT_COMPAT) ?>
"<?php $_input = $_form["znamka_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
  'id' => NULL,
))->attributes() ?>>
<?php if ($desktop==TRUE) { ?>
           <br> 
           <a  onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','1');"><button class="btn btn-primary" type="button">1</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','2');"><button class="btn btn-primary" type="button">2</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','3');"><button class="btn btn-primary" type="button">3</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','4');"><button class="btn btn-primary" type="button">4</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','5');"><button class="btn btn-primary" type="button">5</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','-');"><button class="btn btn-primary" type="button">-</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','*');"><button class="btn btn-primary" type="button">*</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','!');"><button class="btn btn-primary" type="button">!</button></a>
            
<?php } ?>
           </td></tr>  
<?php } ?>
        
<?php if ($sirka!=FALSE) { ?>
           
            <td><textarea  class='form-control' <?php $_input = $_form["znamka_{$pom_cislo}"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea> 
        
<?php if ($desktop==TRUE) { ?>
           <br> 
       <a  onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','1');"><button class="btn btn-primary" type="button">1</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','2');"><button class="btn btn-primary" type="button">2</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','3');"><button class="btn btn-primary" type="button">3</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','4');"><button class="btn btn-primary" type="button">4</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','5');"><button class="btn btn-primary" type="button">5</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','-');"><button class="btn btn-primary" type="button">-</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','*');"><button class="btn btn-primary" type="button">*</button></a> 
            <a onclick="myFunction('znamka_<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($pom_cislo), ENT_COMPAT) ?>','!');"><button class="btn btn-primary" type="button">!</button></a>
<?php } ?>
       
       </td></tr> 
<?php } ?>
        
        
        
        <?php $pom_cislo=$pom_cislo+1 ;$iterations++; } ?>
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
      <tr><td colspan='2' style='text-align:center;'><input  class='form-control btn btn-success'<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>></td></tr>
             
    <tr><td colspan='2' style='color:red; text-align:center; font-weight: bold'>
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

                          
                        
                        
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

              <div class="clearfix"></div>
                      
                      
                      
                      
                      
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