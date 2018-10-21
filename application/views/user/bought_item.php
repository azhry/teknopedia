<div class="container" style="margin-bottom: 24px;">
	<center>
		<h4>Barang yang terjual</h4>
		<hr>
	</center>
	<table class="table">
		<thead>
			<tr>
				<th>Foto</th>
				<th>Nama</th>
				<th>Satuan Harga</th>
				<th>Pcs</th>
				<th>Total</th>
				<th>Tanggal</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($barang_terjual as $row): ?>
				<?php  
					$result = $this->barang_m->get(['id' => $row->id_barang]);
					$barang = [];
					foreach ($result as $r)
					{
						$barang = [
							'nama'		=> $r->nama,
							'harga'		=> $r->harga,
							'pcs'		=> $row->pcs,
							'total'		=> $r->harga * $row->pcs,
							'tanggal'	=> $row->tanggal,
							'status'	=> $row->status
						];
					}
				?>
				<tr>
					<td>
						<img src="<?= base_url('img/barang/'.$row->id_barang.'.png') ?>" width="200" height="200">
					</td>
					<td><?= $barang['nama'] ?></td>
					<td><?= $barang['harga'] ?></td>
					<td><?= $barang['pcs'] ?></td>
					<td><?= $barang['total'] ?></td>
					<td><?= $barang['tanggal'] ?></td>
					<td>
						<?php if ($barang['status'] == 'Terkirim'): ?>
							<span class="text-success"><i class="glyphicon glyphicon-check"></i> Terkirim</span>
						<?php else: ?>
							<a href="<?= base_url('user/update_status_transaksi/'.$row->id_transaksi) ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Belum terkirim</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<hr>
</div>