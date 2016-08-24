<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/Edit/cvZnamka.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2761520986', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbc736cc573b_content')) { function _lbc736cc573b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="right_col" role="main">
         
            <div class="page-title">
              <div class="title_left">
                <h3>Editace čtvrtletní klasifikace <small><?php echo Latte\Runtime\Filters::escapeHtml($zak['cele_jmeno'], ENT_NOQUOTES) ?>
 - <?php echo Latte\Runtime\Filters::escapeHtml($predmet['nazev'], ENT_NOQUOTES) ?></small> </h3>
              </div>

             
            </div>
           
           
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
                  
                  <div class="x_content" >
                    <br>
                    
                       
                       
                      
                       
                       <div class="form-horizontal form-label-left" style="min-height: 680px">
                           
                          
                             
                               
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["editCvZnamka"], array()) ?>
                                     <div class="form-group">
                                   <label class='required control-label col-md-3 col-sm-3 col-xs-12' for="frm-novaZnamka-popis">1. čtvrtletí:</label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input class='form-control col-md-7 col-xs-12'<?php $_input = $_form["ctvrtleti_1"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>>
                                   </div>
                                    </div> 
                                   <div class="form-group">
                                      <label class='required control-label col-md-3 col-sm-3 col-xs-12' for="frm-novaZnamka-popis">Pololetí:</label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input class='form-control col-md-7 col-xs-12'<?php $_input = $_form["ctvrtleti_2"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>>
                                   </div>
                                    </div> 
                                    <div class="form-group">
                                      <label class='required control-label col-md-3 col-sm-3 col-xs-12' for="frm-novaZnamka-popis">3. čtvrtletí:</label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input class='form-control col-md-7 col-xs-12'<?php $_input = $_form["ctvrtleti_3"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>>
                                   </div>
                                    </div>  
                                     
                                     <div class="form-group">
                                      <label class='required control-label col-md-3 col-sm-3 col-xs-12' for="frm-novaZnamka-popis">Konec roku:</label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input class='form-control col-md-7 col-xs-12'<?php $_input = $_form["ctvrtleti_4"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>>
                                   </div>
                                    </div> 
                                     
                                     
                                     
                                      <div class="form-group">
                                        <div class="col-md-offset-3">
                                       <input  class='btn btn-success'<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><input  class='btn btn-info'<?php $_input = $_form["zpet"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>>
                                       </div>
                                         </div>
                                     
                                     
                                    
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ;$iterations = 0; foreach ($flashes as $flash) { ?>
                                <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
" style='<?php if ($flash->message=='Uživatel byl úspěšně editován.') { ?>
 color:green <?php } ?>'><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

                                 

                             
                              
                                     
                                  
                                    
                          
                         
                                    
                                


                             
                          
                       
                         </div>

                        <br>
                   
                    
                    
                    
                    
                    
                    
                    
                  
              </div>
                       
                      
            </div>
                       
          </div>
                       
        </div>
                       
                       
                       
                       </div>
        <!-- /page content -->
<!-- bootstrap-daterangepicker -->
   

   
    <script>
        function zpetNaSeznam(){
            window.location = <?php echo Latte\Runtime\Filters::escapeJs($basePath) ?> + "/seznam/cv-ucitel";
        }
      $(document).ready(function() {
          
          
          
        $('#single_cal1').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_1"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal2').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_2",
           format: 'YYYY-MM-DD'
           
          
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal3').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_3"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal4').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#reservation').daterangepicker(null, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->






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