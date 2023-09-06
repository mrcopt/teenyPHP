<?=partial('head');?>
<div class="flex-center full-height">
	<div class="content">
		<div class="title"><?=APP['NAME']?></div>
		<div class="working">
			<h1>teenyPHP Framework is working!</h1>
			<p>Configure your database and start developing</p>
		</div>
		<div class="system-info">
			<?php  
			foreach (APP as $key => $value) {
				print('<div class="system-item">');
				print('<div class="label">'.ucfirst(strtolower($key)).':</div>');
				print('<div class="value">'.$value.'</div>');
				print('</div>');
			}
			?>
		</div>
	</div>
</div>
<?=partial('foot');?>