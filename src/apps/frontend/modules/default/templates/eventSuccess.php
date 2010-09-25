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
            <?php echo link_to('Hide Edit Area', '@event?event_code='.$event->code) ?>
            | <?php echo link_to('Back Home', '@homepage') ?>

        </li>
        <li class="section_break">
        <?php endif ?>



            <table class="table" id="maintable" cellspacing="0" cellpadding="0">
                <tr class="rowa">
                    <td class="col1 cell">Name</td>
                    <td class="col2 cell">Charity</td>
                    <td class="col3 cell">Total</td>
                    <?php if ($canEdit): ?>
                    <td class="col3 cell">Delete</td>
                    <?php endif ?>
                </tr>



            <?php foreach ($pages as $page): ?>
                <tr class="rowb">
                    <td class="col1 cell"><a
                            href="http://v3.staging.justgiving.com/<?php echo $page->short_name ?>" target="_blank"><?php echo $page->title ?></a>
                    </td>
                    <td class="col2 cell"><?php echo $page->charity_name ?></td>
                    <td class="col3 cell">&pound;<?php echo ($page->money_raised != null) ? $page->money_raised : '0.00'  ?></td>
                    <?php if ($canEdit): ?>
                    <td class="col4 cell"><?php echo link_to('Delete', '@admin_page_delete?id='.$page->id) ?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>

            <?php if (count($pages) == 0): ?>
                <tr class="rowb">
                    <td colspan="4">There are no pages tied to this event yet.</td>
                </tr>
            <?php endif ?>

            </table>
    </ul>
</form>
