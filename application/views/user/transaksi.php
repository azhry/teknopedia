<div class="container" style="margin-bottom: 24px;">
	<center>
		<h4>Transaksi Anda</h4>
		<hr>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Transaction ID</th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Total</th>
					<th>Status</th>
					<th>Tanggal</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; foreach ($transaksi as $row): ?>
					<tr>
						<td><?= ++$i ?></td>
						<td><?= $row->id_transaksi ?></td>
						<td>
							<?php  
								$barang = $this->barang_m->get(['id' => $row->id_barang]);
								$nama = '';
								foreach ($barang as $r)
									$nama = $r->nama;
								echo $nama;
							?>
						</td>
						<td><?= $row->pcs ?></td>
						<td><?= $row->harga * $row->pcs ?></td>
						<td><?= $row->status ?></td>
						<td><?= $row->tanggal ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<hr>
	</center>	
</div>