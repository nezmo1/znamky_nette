<?php
// source: D:\xampp\htdocs\znamky_nette\sandbox\app/templates/Informace/informace.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8205859000', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
Vítejte 
Jste přihlášen jako

<?php $iterations = 0; foreach ($info as $post) { ?>
<div class="post">
    <div class="date"><?php echo Latte\Runtime\Filters::escapeHtml($post->username, ENT_NOQUOTES) ?></div>



  
</div>
<?php $iterations++; } ?>

