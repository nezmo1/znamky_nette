<?php
// source: D:\xampp\htdocs\znamky_nette\sandbox\app/templates/Users/../components/@full.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3222541007', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block filter-cell-birthday
//
if (!function_exists($_b->blocks['filter-cell-birthday'][] = '_lb1a35bf0331_filter_cell_birthday')) { function _lb1a35bf0331_filter_cell_birthday($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<th class="birthday nowrap">
		<div>
			<?php echo $_form["filters-criteria-$column-min"]->getControl()->addAttributes(array('class' => 'form-control date min', 'placeholder' => 'min')) ?>

			<?php echo $_form["filters-criteria-$column-max"]->getControl()->addAttributes(array('class' => 'form-control date max', 'placeholder' => 'max')) ?>

			&ndash;
		</div>
	</th>
<?php
}}

//
// block filter-cell-kilograms
//
if (!function_exists($_b->blocks['filter-cell-kilograms'][] = '_lb89d9233f62_filter_cell_kilograms')) { function _lb89d9233f62_filter_cell_kilograms($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<th class="numeric">
		<?php echo $_form["filters-criteria-$column"]->getControl()->addAttributes(array('class' => 'form-control')) ?>

	</th>
<?php
}}

//
// block body-cell-birthday
//
if (!function_exists($_b->blocks['body-cell-birthday'][] = '_lb95637ab3eb_body_cell_birthday')) { function _lb95637ab3eb_body_cell_birthday($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<td class="numeric center"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($value, 'd. m. Y'), ENT_NOQUOTES) ?></td>
<?php
}}

//
// block body-cell-birthday-inline
//
if (!function_exists($_b->blocks['body-cell-birthday-inline'][] = '_lb1ce8493400_body_cell_birthday_inline')) { function _lb1ce8493400_body_cell_birthday_inline($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<td><?php echo $_form["inline-values-$column"]->getControl()->addAttributes(array('class' => 'form-control date center')) ?></td>
<?php
}}

//
// block body-cell-country_code
//
if (!function_exists($_b->blocks['body-cell-country_code'][] = '_lb073eec0cd3_body_cell_country_code')) { function _lb073eec0cd3_body_cell_country_code($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<td><?php echo Latte\Runtime\Filters::escapeHtml($record->ref('country', 'country_code')->title, ENT_NOQUOTES) ?></td>
<?php
}}

//
// block body-cell-kilograms
//
if (!function_exists($_b->blocks['body-cell-kilograms'][] = '_lb2138bdcee5_body_cell_kilograms')) { function _lb2138bdcee5_body_cell_kilograms($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<td class="numeric right"><?php echo Latte\Runtime\Filters::escapeHtml($value, ENT_NOQUOTES) ?></td>
<?php
}}

//
// block body-cell-kilograms-inline
//
if (!function_exists($_b->blocks['body-cell-kilograms-inline'][] = '_lbc0a65a8b81_body_cell_kilograms_inline')) { function _lbc0a65a8b81_body_cell_kilograms_inline($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<td class="numeric"><?php echo $_form["inline-values-$column"]->getControl()->addAttributes(array('class' => 'form-control')) ?></td>
<?php
}}

//
// block row-action-delete
//
if (!function_exists($_b->blocks['row-action-delete'][] = '_lb601e75c5a7_row_action_delete')) { function _lb601e75c5a7_row_action_delete($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($link), ENT_COMPAT) ?>
" class="btn btn-danger btn-sm tw-ajax" data-tw-confirm="<?php echo Latte\Runtime\Filters::escapeHtml($action->confirmation, ENT_COMPAT) ?>">
		<?php echo Latte\Runtime\Filters::escapeHtml($action->label, ENT_NOQUOTES) ?>

	</a>
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

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>














