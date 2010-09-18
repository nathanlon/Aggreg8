<ul>
<?php foreach($pages as $page) { ?>
	<li><?php echo $page->getId() ?> <?php echo $page->getJustGivingPageCode()?> </li>
<?php } ?>
</ul>