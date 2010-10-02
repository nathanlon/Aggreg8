<?php slot('pageName', $pageName) ?>

<div class="form_description">
    <h2>Aggreg8.me</h2>

    <p>Grand totals for <?php echo $event->name ?>.</p>

    <?php echo link_to('Back to event', '@admin_event?event_code='.$event->code, array('id'=>'back_to_event')) ?>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        $('#themes input').change(function() {
            $('#theme_preview').attr('src', '<?php echo url_for('@event?event_code='.$event->code.'&embedded=embedded', true) ?>'+'/'+$(this).val());

            $('textarea#embed_code').val('<iframe src="<?php echo url_for('@event?event_code='.$event->code.'&embedded=embedded', true) ?>'+'/'+$(this).val()+'" width="490" height="300"></iframe>');
        });
    });

</script>

<h2>Embed this page in your website</h2>

<h3>Select your colour scheme</h3>

<div id="themes">
<?php for ($i=1; $i <= 25; $i++):
    $selected = ($i == 1)? ' checked="yes"' : '';
?>
    <input type="radio" name="theme" id="theme<?php echo $i ?>"value="<?php echo $i ?>"<?php echo $selected ?> /> <label for="<?php echo 'theme'.$i ?>"><?php echo 'Theme '.$i ?></label>
<?php endfor ?>
</div>

<h3 id="embed_code_head">Get the embed code</h3>
<p id="embed_code_desc">Copy and paste the code below into your website to add this page.</p>

<textarea rows="2" cols="30" id="embed_code">
&lt;iframe src="<?php echo url_for('@event?event_code='.$event->code.'&embedded=embedded', true) ?>/1" width="490" height="300"&gt;&lt;/iframe&gt;
</textarea>

<h3>Preview the embedded page</h3>

<iframe id="theme_preview" src="<?php echo url_for('@event?event_code='.$event->code.'&embedded=embedded', true) ?>/1" width="490" height="300" frameborder="0"></iframe>
