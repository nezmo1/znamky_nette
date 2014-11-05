<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/Homepage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8762230157', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb1eaa5fc889_content')) { function _lb1eaa5fc889_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Hlavní strana</h1>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Postup práce na elektronické žákovské knížce'
            },
            
            xAxis: {
                categories: ['Vzhled', 'Uživatelské rozhraní', 'Administrátorské rozhraní', 'Funkce'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Postup (%)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' %'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
           
            credits: {
                enabled: false
            },
            series: [{
                name: 'Postup',
                data: [100, 95, 90, 90]
            }]
        });
    });
    

		</script>
	</head>
	<body>
            <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/grafy/js/highcharts.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/grafy/js/modules/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>










 <p style="text-align:center"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/working.png" width="500px" height="500px"></p>
 
 
 
 
 
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb13e89da1f0_scripts')) { function _lb13e89da1f0_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacros::callBlockParent($_b, 'scripts', get_defined_vars()) ?>
<script src="http://jush.sourceforge.net/jush.js"></script>

<script>

</script>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb89b10b8747_head')) { function _lb89b10b8747_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>



<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 