<?php
// source: D:\xampp\htdocs\znamky_nette\sandbox\app/templates/menu.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4990116293', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
echo Latte\Runtime\Filters::escapeHtml($menu, ENT_NOQUOTES) ;