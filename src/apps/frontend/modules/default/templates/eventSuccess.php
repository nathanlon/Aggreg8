<?php slot('pageName', $pageName) ?>
		<form id="form_15307" class="appnitro"  method="get" action="/event/good/form">
					<div class="form_description">
			<h2>Aggreg8.me</h2>
			<p>Grand totals for <?php echo $event->name ?>.</p>
		</div>
			<ul >
			<div id="grand_total">
			<p>&pound;<?php echo $event->total_money ?></p>
			</div>
		</li>

                                        <li class="buttons">
                            <input type="hidden" name="form_id" value="15307" />

                                <input id="saveForm" class="button_text" type="submit" name="submit" value="Create a Page " />
                </li>
		<li class="section_break">


<table class="table" id="maintable" cellspacing="0" cellpadding="0">
	<tr class="rowa">
		<td class="col1 cell">Name</td>
		<td class="col2 cell">Charity</td>
		<td class="col3 cell">Total</td>
	</tr>

    <?php foreach ($pages as $page): ?>
 	<tr class="rowb">
		<td class="col1 cell"><a href="http://v3.staging.justgiving.com/<?php echo $page->short_name ?>"><?php echo $page->title ?></a></td>
		<td class="col2 cell"><?php echo $page->charity_name ?></td>
		<td class="col3 cell">&pound;<?php echo ($page->money_raised != null)?$page->money_raised : '0.00'  ?></td>
	</tr>
    <?php endforeach ?>

 </table>
			</ul>
		</form>
