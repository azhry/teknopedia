<div class="container">
	<center>
		<h4>Recent user item</h4>
	</center>
	<?php foreach ($items as $item): ?>
		<div class="panel panel-default" style="height: 200px;">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<center>
							<img src="<?= base_url('img/barang/'.$item->id.'.png') ?>" style="width: 55%; height: 170px;">	
						</center>
					</div>
					<div class="col-md-8">
						<div class="row" style="height: 100px;">
							<p><?= substr($item->deskripsi, 0, 350) . '...' ?></p>
						</div>
						<hr>
						<div class="row">
							<p class="pull-left"><i><?= $item->nama ?></i></p>
							<p class="pull-right" style="padding-right: 24px;"><strong>Price: Rp. <?= $item->harga ?></strong>  - <a href="<?= base_url('admin/detail/'.$item->id) ?>">Lihat</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	<?= $pagination ?>
</div>