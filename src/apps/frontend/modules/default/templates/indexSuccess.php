<?php slot('pageName', $pageName) ?>

<div class="form_description">
    <h2>Aggreg8.me</h2>

    <p>Aggregate the total money raised by your event.</p>
</div>

<div id="grand_total">
    <div id="totalDesc">Currently Aggreg8ing events totalling:</div>
    <p>&pound;<?php echo $allEventsTotal ?></p>
</div>

<div class="buttons ">
    <form class="blank" method="get" action="<?php echo url_for('@admin_event_new') ?>">
        <input class="button_text" type="submit" name="submit" value="Create an Event "/>
    </form>
</div>

<div class="data">

    <table class="table" id="maintable" cellspacing="0" cellpadding="0">
        <tr class="rowa">
            <td class="col1 cell">Latest Events using Aggreg8.me</td>
            <td class="col3 cell">Total</td>
        </tr>
    <?php foreach ($events as $event): ?>
        <tr class="rowb">
            <td class="col1 cell"><a href="/event/<?php echo $event->code ?>"><?php echo $event->name ?></a></td>
            <td class="col3 cell">&pound;<?php echo $event->total_money ?></td>
        </tr>
    <?php endforeach ?>
    </table>

</div>
