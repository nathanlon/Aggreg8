<?php echo $form->renderFormTag(url_for('@form?event_code=' . $eventCode)) ?>

<div class="form_description">
    <h2>Aggreg8.me</h2>

    <p>Create a new Just Giving page, or add an existing page to the aggregator.</p>
</div>
<ul>
<?php if ($sf_user->hasFlash('message')): ?>
    <?php echo '<div class="flash">'.$sf_user->getFlash('message') . '</div>'; ?>
<?php endif; ?>
    
<?php echo $error ?>
    <h3>New Page</h3>

    <p></p>
    </li>

    <li id="li_1">
        <label class="description" for="element_1">Page Title</label>

        <div>
        <?php echo $form['title']->render() ?>
        </div>
    </li>
    <li id="li_11">
        <label class="description" for="page_short_name">Short Name</label>

        <div>
        <?php echo $form['short_name']->render() ?>
        </div>
    </li>
    <li id="li_10">
        <label class="description" for="page_target_amount">Target Amount</label>

        <div>
        <?php echo $form['target_amount']->render() ?>
        </div>
    </li>
    <li id="li_9">
        <label class="description" for="page_charity_code">Charity Id</label>

        <div>
        <?php echo $form['charity_code']->render($sf_data->getRaw('charityCodeArray')) ?> <?php echo $charityName ?>
        </div>
        <?php
        $charityArray = array();
        if ($charityName != ''):
            $charityArray = array('value' => $charityName);
        endif;
        ?>
        
        <?php echo $form['charity_name']->render($charityArray) ?>
    </li>
    <li id="li_9">
        <label class="description" for="page_charity_search">OR Charity Search</label>

        <div>
        <?php echo $form['charity_search']->render() ?> (clear charity code above to search)
        </div>
    </li>
    <li class="buttons">

        <input id="saveForm1" class="button_text" type="submit" name="submit" value="Submit"/>
    </li>
</ul>
<?php echo $form->renderHiddenFields() ?>

<hr/>


    <h3>OR: Existing Page</h3>

<li id="li_11">
    <label class="description" for="page_short_name">Existing Just Giving Short Name</label>

    <div>
    <?php echo $form['existing_short_name']->render() ?>
    </div>

</li>

<li class="buttons">
    <input id="saveForm2" class="button_text" type="submit" name="submit" value="Submit"/>
</li>



</form>