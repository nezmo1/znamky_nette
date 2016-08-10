<?php
// source: D:\xampp\htdocs\znamky_nette\znamky_nette\sandbox\app/templates/Homepage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2970436291', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb18328cca8d_content')) { function _lb18328cca8d_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Elektronická žákovská knížka</h1>

 		
 
 <table style="text-align:justify"> 
         
                               
<tr><td width="200px"><img src="./images/boy.png" style="float:left" title="Rodiče tohoto kluka dostali řádně zaplaceno" width="75%" height="75%"></td>
<p><td valign="middle" style="padding-right:40px">Elektronická žákovská knížka (Žako) je odpovědí na rozvoj počítačové technologie ve všech vědách jí zasaženou, především v pedagogice. Hodnocení žáků se pomalu přesouvá do oblasti informatiky a Žako se stal jednou z možných voleb k realizaci tohoto trendu.</p>
 </td></tr>

 
 </table> 
 <table style="text-align:justify"> 
         
 <table style="text-align:justify">                              
<tr>
<p><td valign="middle" style="padding-left:40px">Ve stručnosti jde říct, že se tedy jedná o zaznamenávání hodnocení žáka (respektive osobě vykonávající proces vyučování – učení se) a jejím následným výpisem pro účely zpětné vazby a kontroly do elektronické podoby.
 </td>
 <td width="200px"><img src="./images/girl.png" style="float:left" title="Mladší sestra svého strašího bratra"></td>
 </tr>

 
 </table> 
 
  
 <table style="text-align:justify"> 
         
                               
<tr><td width="200px"><img src="./images/alice2.png" style="float:left" title="Příliš malá na takto velký seznam"></td>
<p><td valign="middle" style="padding-right:40px">

<p><font style="font-size:24px">Oproti klasické žákovské knížce má Žako řadu výhod:</font></p>
<br>
<ul>
<li>	<i>Přístup ke svým známkám (účtu) odkudkoli, kde je k dispozici internet. </i></li>  <br>
<li>	<i>Aktuálnost známek mimo pracovní/školní dny, kdy má vyučující možnost udělené známky ihned zapsat do systému.</i></li>    <br>
<li>	<i>Kontrolní součty, výpisy známek dle předmětů a čtvrtletní klasifikace na jednom místě umožňuje jednoduchý přehled o pokroku při zvládnutí učiva v celém školním roce.  </li> </i> <br>
</ul>

</td></tr>

 
 </table>  
  

         
 <table style="text-align:justify">                              
<tr>
<p><td valign="middle" style="padding-left:40px">  Bezpečnost na internetu byla/je hlavní prioritou při vývoji Žaka a za pomocí jednosměrného šifrování a dalších bezpečnostních opatření, kdy je kladen důraz na izolaci žákových vlastních záznamu. Tudíž je šance na odcizení mnohonásobně menší ve srovnání s odcizením klasické žákovské knížky.    </td>
 <td width="200px"><img src="./images/shield.png" style="float:left" title="Štít udatného štítonoše" width="85%" height="85%"></td>
 </tr>            
  </table> 
  
  
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb510ed72e7c_head')) { function _lb510ed72e7c_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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



<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 