<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/Uvazek/seznamucitelu.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0654174270', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb8704d45d86_content')) { function _lb8704d45d86_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$iterations = 0; foreach ($ucitele as $ucitel) { ?>
<div class="post">
<h2><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uvazek:uciteluvazek", array($ucitel->id_users)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($ucitel->prijmeni, ENT_NOQUOTES) ?></a></h2>

  
</div>
<?php $iterations++; } ?>
<br>
<?php $_l->tmp = $_control->getComponent("viteze"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render(2) ;
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