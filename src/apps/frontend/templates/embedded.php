<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>

    <div id="form_container" class="<?php include_slot('pageName') ?>">

        <?php if ($sf_user->hasFlash('message')): ?>
        <?php echo '<div class="flash">' . $sf_user->getFlash('message') . '</div>'; ?>
        <?php endif; ?>

        <?php echo $sf_content ?>

        <div id="footer">
            Made with <?php echo link_to('Aggreg8.me', '@homepage', array('target'=>'_blank'), true) ?> - A Charity Hack 2010 project
        </div>
    </div>

  </body>
</html>
