<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/Prehled/portal.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2311878565', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf023d8620f_content')) { function _lbf023d8620f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars()) ; if ($reditel!=FALSE or $user->isInRole('4')) { ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link('Prehled:UciteleZnamky'), ENT_COMPAT) ?>
"><?php } ?>

<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/notes_ucitele_prehled.png" alt="prehled_znamek">
<?php if ($reditel!=FALSE or $user->isInRole('4')) { ?></a><?php } ?>


<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lbd7d6007be5_title')) { function _lbd7d6007be5_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Přehled školy</h1>
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