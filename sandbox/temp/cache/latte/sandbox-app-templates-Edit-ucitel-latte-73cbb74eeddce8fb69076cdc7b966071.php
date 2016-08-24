<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/Edit/ucitel.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2919323374', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbde11fd45b0_content')) { function _lbde11fd45b0_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="right_col" role="main">
         
            <div class="page-title">
              <div class="title_left">
                <h3>Editace uživatele</h3>
              </div>

             
            </div>
           
           
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
                  
                  <div class="x_content" >
                    <br>
                    
                       
                       
                      
                       
                     

  
   
 <div class="form-horizontal form-label-left" style="min-height: 680px">
                           
                          
                                        
                          
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["novyUcitel"], array($form)) ;if ($form->ownErrors) { ?><ul class=error>
<?php $iterations = 0; foreach ($form->ownErrors as $error) { ?>	<li><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
</ul>
<?php } ?>


<?php $iterations = 0; foreach ($form->controls as $input) { ?><div class="form-group"<?php if ($_l->tmp = array_filter(array($input->required ? 'required' : NULL))) echo ' class="' . Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php if (($input->name != "send")  &&  ($input->name != "zpet")) { ?>
        <?php $_input = is_object($input) ? $input : $_form[$input]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array('class' => 'required control-label col-md-3 col-sm-3 col-xs-12'))  ?>

	<div class="col-md-6 col-sm-6 col-xs-12">
        <?php $_input = is_object($input) ? $input : $_form[$input]; echo $_input->getControl()->addAttributes(array('class' => 'form-control')) ?>
 <?php ob_start() ?><span class=error><?php ob_start() ;echo Latte\Runtime\Filters::escapeHtml($input->error, ENT_NOQUOTES) ;$_l->ifcontent = ob_get_contents(); ob_end_flush() ?></span>
<?php rtrim($_l->ifcontent) === "" ? ob_end_clean() : ob_end_flush() ;} ?>
        
        
       
            
        
</div>
<?php if ($input->name == "send") { ?>
                                       <div class="col-md-offset-3">
                                       <input  class='btn btn-success'<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><input  class='btn btn-info'<?php $_input = $_form["zpet"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>>
                                       </div>
<?php } ?>
           
</div>
<?php $iterations++; } ?>
        
        
      
                                       
        
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
                               
                                
<?php $iterations = 0; foreach ($flashes as $flash) { ?>
                                <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
" style='<?php if ($flash->message=='Uživatel byl úspěšně editován.') { ?>
 color:green <?php } ?>'><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

                                 

                             
                              
                         
                                  
    
                          
                                    
                                


                             
                          
                       
                         </div>
                                 

                             
                              
                                     
                                  
                                    
                          
                         
                                    
                                


                             
                          
                       
                         </div>

                        <br>
                   
                    
                    
                    
                    
                    
                    
                    
                  
              </div>
                       
                      
            </div>
                       
          </div>
                       
        </div>
                       
                       
                       
                       </div>

                       
<script>
        function zpetNaSeznam(){
            window.location = <?php echo Latte\Runtime\Filters::escapeJs($basePath) ?> + "/users/list";
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ?>
  