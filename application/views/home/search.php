<div class="container" style="margin-bottom: 24px;">
	<p>Hasil pencarian <?= $total_pencarian ?> ditemukan</p>
	<hr>
	<div class="row">
		<?php foreach ($barang as $row): ?>
			<div class="col-md-4">
				<div class="panel panel-default">
				  <a href="<?= base_url('home/details/' . $row->id) ?>" class="panel-body">
				  	<center>
				  		<img src="<?= base_url('img/barang/'. $row->id . '.png') ?>" width="320" height="220"
				  		style="border: 1px solid grey; box-sizing: border-box; box-shadow: 2px 2px grey;">
				  		<b><?= $row->nama ?></b>				  		
				  	</center>
				  </a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>