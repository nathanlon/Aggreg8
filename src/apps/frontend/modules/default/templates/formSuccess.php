<?php //echo $form->render() ?>

    <form id="form_15307" class="appnitro"  method="post" action="">
                <div class="form_description">
        <h2>Aggreg8.me</h2>
        <p>Create a new Just Giving page</p>
    </div>
        <ul >

      
        <h3>New Page</h3>
        <p></p>
    </li>
            <li id="li_1" >
    <label class="description" for="element_1">Page Title</label>
    <div>
        <?php echo $form['title']->render() ?>
    </div>
    </li>		<li id="li_11" >
    <label class="description" for="element_11">Short Name</label>
    <div>
        <?php echo $form['short_name']->render() ?>
    </div>
    </li>		<li id="li_10" >
    <label class="description" for="element_10">Target Amount</label>
    <div>
        <?php echo $form['target_amount']->render() ?>
    </div>
    </li>		<li id="li_9" >
    <label class="description" for="element_9">Charity Id</label>
    <div>
        <?php echo $form['charity_code']->render() ?>
    </div>
    </li>

                <li class="buttons">
            <input type="hidden" name="form_id" value="15307" />

            <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
    </li>
        </ul>
    </form>
