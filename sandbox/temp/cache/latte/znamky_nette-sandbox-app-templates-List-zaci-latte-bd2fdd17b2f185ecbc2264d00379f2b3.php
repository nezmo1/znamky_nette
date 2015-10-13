<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/List/zaci.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6034069616', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbb7723b2769_content')) { function _lbb7723b2769_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>


<?php $_l->tmp = $_control->getComponent("seznamZakuGrid"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

<br>
<?php $_l->tmp = $_control->getComponent("viteze"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render(4) ;
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb8741d28c3e_title')) { function _lb8741d28c3e_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Seznam žáků</h1>
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