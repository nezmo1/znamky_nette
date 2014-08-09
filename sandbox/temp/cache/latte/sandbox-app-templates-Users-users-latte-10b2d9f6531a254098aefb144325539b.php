<?php
// source: D:\xampp\htdocs\znamky_nette\sandbox\app/templates/Users/users.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6347249197', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb8ef67b5746_content')) { function _lb8ef67b5746_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
 ?>



<?php
}}

//
// block col-nickname
//
if (!function_exists($_b->blocks['col-nickname'][] = '_lb78f01e55a5_col_nickname')) { function _lb78f01e55a5_col_nickname($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><td>
    <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Users:", array('id' => $row->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($cell, ENT_NOQUOTES) ?></a>
</td>
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