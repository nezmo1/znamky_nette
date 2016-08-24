<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/Prehled/ucitelSeznam.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9596864968', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3e310381d3_content')) { function _lb3e310381d3_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
    if (confirm("Opravdu chcete smazat tuto třídu?")) {
       
        return true;
    } else {
       
        return false;
    }
}
</script>

<div class="right_col" role="main">
         
            <div class="page-title">
              <div class="title_left">
               
<h3>Seznam známek <small><?php echo Latte\Runtime\Filters::escapeHtml($jmeno_ucitele->cele_jmeno, ENT_NOQUOTES) ?></small></h3>
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
                    <h2></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

<?php $_l->tmp = $_control->getComponent("seznamZnamekDetailReditelGrid"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

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