
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
