<?php
// source: D:\xampp\htdocs\znamky_nette\sandbox\app/templates/Uvazek/seznamucitelu.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7432124603', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbc5470b8aa2_content')) { function _lbc5470b8aa2_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$iterations = 0; foreach ($ucitele as $ucitel) { ?>
<div class="post">
<h2><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uvazek:uciteluvazek", array($ucitel->username)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($ucitel->prijmeni, ENT_NOQUOTES) ?></a></h2>

  
</div>
<?php $iterations++; } 
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