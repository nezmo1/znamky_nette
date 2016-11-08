<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/Prehled/portal.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0159223219', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbacfd06ed99_content')) { function _lbacfd06ed99_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="right_col" role="main">
         
            <div class="page-title">
              <div class="title_left">
                  <h3>Přehled školy <small></small></h3>
              </div>

             
            </div>
           
           
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12"  >
                <div class="x_panel" >
                  
                  <div class="x_content" style="min-height: 680px">
                    <br>
                    
                       
                       
<?php call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars()) ; if ($reditel!=FALSE or $user->isInRole('4')) { ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link('Prehled:UciteleZnamky'), ENT_COMPAT) ?>
"><?php } ?>

<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/notes_ucitele_prehled.png" alt="prehled_znamek"><?php if ($reditel!=FALSE or $user->isInRole('4')) { ?>
</a><?php } ?>

<?php if ($reditel!=FALSE or $user->isInRole('4')) { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link('Prehled:UciteleKlasifikace'), ENT_COMPAT) ?>
"><?php } ?>

<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/notes_ucitele_klasifikace.png" alt="prehled_znamek"><?php if ($reditel!=FALSE or $user->isInRole('4')) { ?>
</a><?php } ?>

 

<br>
                       
           
                             
                          
                       
                         </div>

                        <br>
                   
                    
                    
                    
                    
                    
                    
                    
                  
              </div>
                       
                      
            </div>
                       
          </div>
                       
        </div>
                       
                       
                       
                       </div>

                       


    
  





<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb3298d5a659_title')) { function _lb3298d5a659_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>                      <h1>Přehled školy</h1>
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