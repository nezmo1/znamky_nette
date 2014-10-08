<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/Novy/trida.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5633937865', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb7a7dc1b169_content')) { function _lb7a7dc1b169_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class='datagrid' style='width:60%; margin-left:20%'>
<table>
    <thead><tr ><th colspan='2' style='font-size:18px; text-align: center'>Nová třída</th></tr></thead>
<?php $_l->tmp = $_control->getComponent("novyTrida"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
    <tr><td colspan='2' style='color:red; text-align:center; background:yellow; font-weight: bold'>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>
    <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
" style='<?php if ($flash->message=='Třída byla úspěšně přidána do databáze.') { ?>
 color:green <?php } ?>'><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
        </td>
    
    </tr>
    
</table>   
   </div> 
    
 <br>
<?php $_l->tmp = $_control->getComponent("viteze"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render(6) ?>

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