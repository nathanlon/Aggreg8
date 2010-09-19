<?php foreach($pages as $page) { ?>
	<hr>	
	Page ID: <?php echo $page->getId(); ?> <br/>
	Page Code: <?php echo $page->getJustGivingPageCode(); ?> <br/>
	Event ID: <?php echo $page->getJustGivingEvent()->getId(); ?><br/>
	Event Code: <?php echo $page->getJustGivingEvent()->getJgEventCode(); ?><br/>
<?php } ?>

	<img id="top" src="/images/top.png" alt="">
	<div id="form_container">
		<h1><a>Aggreg8.me</a></h1>
		<form id="form_15307" class="appnitro"  method="post" action="form.html">
					<div class="form_description">
			<h2>Aggreg8.me</h2>
			<p>Grand totals for Gooddwood Roller Marathon 2010.</p>
		</div>
			<ul >
			<div id="grand_total">
			<p>&pound;<?php echo $eventTotal ?></p>
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
		<td class="col1 cell"><?php echo $page->user ?></td>
		<td class="col2 cell"><?php echo $page->charity_name ?></td>
		<td class="col3 cell">&pound;<?php echo $page->money_raised ?></td>
	</tr>
    <?php endforeach ?>

 </table>
			</ul>
		</form>
		<div id="footer">
			A Charity Hack 2010 project
		</div>
	</div>
	<img id="bottom" src="/images/bottom.png" alt="">