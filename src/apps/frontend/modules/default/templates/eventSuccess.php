<?php slot('pageName', $pageName) ?>
<form class="appnitro" method="get" action="/event/<?php echo $event->code ?>/form">
    <div class="form_description">
        <h2>Aggreg8.me</h2>

        <p>Grand totals for <?php echo $event->name ?>.</p>
    </div>
    <ul>
        <div id="grand_total">
            <p>&pound;<?php echo ($event->total_money != '')?$event->total_money : '0.00' ?></p>
        </div>
        </li>

        <?php if ($canEdit): ?>
        <li class="buttons">
            <input id="saveForm" class="button_text" type="submit" name="submit" value="Create a Page "/>
            <?php //echo link_to('Hide Edit Area', '@event?event_code='.$event->code) ?>
            | <?php echo link_to('Back Home', '@homepage') ?>
            | <?php echo link_to('Embed this page', '@event_embed?event_code='.$event->code) ?>

        </li>
        <li class="section_break">
        <?php endif ?>

        <?php include_partial('default/event', array('canEdit'=>$canEdit,'pages'=>$pages)) ?>

    </ul>
</form>
