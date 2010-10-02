<?php slot('pageName', $pageName) ?>

<p id="grand_total_desc">Grand totals for <?php echo $event->name ?>.</p>

<div id="grand_total">
    <p>&pound;<?php echo ($event->total_money != '')?$event->total_money : '0.00' ?></p>
</div>

<?php include_partial('default/event', array('canEdit'=>$canEdit,'pages'=>$pages)) ?>