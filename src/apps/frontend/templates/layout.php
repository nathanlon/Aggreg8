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

	<img id="top" src="/images/top.png" alt="">
	<div id="form_container" class="<?php include_slot('pageName') ?>">
		<h1><a href="/">Aggreg8.me</a></h1>

        <?php echo $sf_content ?>

		<div id="footer">
			A Charity Hack 2010 project
		</div>
	</div>
	<img id="bottom" src="/images/bottom.png" alt="">

  </body>
</html>
