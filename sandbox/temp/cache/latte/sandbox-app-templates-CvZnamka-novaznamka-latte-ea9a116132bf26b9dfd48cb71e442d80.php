<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/CvZnamka/novaznamka.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6946949007', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbb8213f7e3f_content')) { function _lbb8213f7e3f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="right_col" role="main">
         
            <div class="page-title">
              <div class="title_left">
                <h3>Přidání nové čtvrtletní klasifikace</h3>
              </div>

             
            </div>
           
           
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel" >
                  
                  <div class="x_content" >
                    <br>
                    
                       
                       <?php if ($uspech=="ano") { ?><h3>Známky byly úspěšně vloženy do databáze</h3><?php } ?>

                      
                       
                       <div class="form-horizontal form-label-left" style="min-height: 680px">
                           
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["novaZnamka"], array()) ?>
                             <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Třída:</label>
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                 <select class="form-control col-md-7 col-xs-12" onchange="location.href='novaznamka?tridac=' + this.options[this.selectedIndex].value "<?php $_input = $_form["trida"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
  'onchange' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select> 
                                 </div>
                                  </div>
                              
<?php if ($trida_p!='n') { ?>
                                     
                                    <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Předmět nebo skupina:</label>    
                                    <div class="col-md-6 col-sm-6 col-xs-12">    
                                    <select class='udaje form-control col-md-7 col-xs-12' <?php $_input = $_form["predmet"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select>   
                                    </div>
                                    </div>
                                    
                               
                                    
                                     <div class="form-group">
                                    <label class='required control-label col-md-3 col-sm-3 col-xs-12'>Váha známky:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class='form-control col-md-7 col-xs-12' <?php $_input = $_form["ctvrtleti"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select>
                                    </div>
                                    </div>
                                    
                                   

                                    <div class="form-group">
                                        <div class="col-md-offset-3">
                                       <input  class='btn btn-success'<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>>
                                       </div>
                                         </div>
                                    
                          
                         
                                    
<?php } ?>


                             
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
                       
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