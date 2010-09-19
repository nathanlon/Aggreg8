<?php foreach($pages as $page) { ?>
	<hr>	
	Page ID: <?php echo $page->getId(); ?> <br/>
	Page Code: <?php echo $page->getJustGivingPageCode(); ?> <br/>
	Event ID: <?php echo $page->getJustGivingEvent()->getId(); ?><br/>
	Event Code: <?php echo $page->getJustGivingEvent()->getJgEventCode(); ?><br/>
<?php } ?>
