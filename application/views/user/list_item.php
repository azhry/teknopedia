<div class="container" style="margin-bottom: 24px;">
	<div class="row">
		<div class="col-md-4">
			<table class="table">
				<?php foreach ($barang as $row): ?>
					<tr>
						<td style="text-align: center;"><a href="#" onclick="displayItem(<?= $row->id ?>)"><?= $row->nama ?></a></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div class="col-md-8">
			<div id="display_item">
				<div id="image_display" style="border: 1px solid grey; box-shadow: 3px 3px grey; margin: 0 auto; width: 300px; height: 300px;">
				</div>
				<br>
				<div align="middle">
					<div id="detail" style="border: 1px solid grey; width: 70%; height: 250px;">
						<table class="table">
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function displayItem(id)
	{
		$('#display_item').load('<?= base_url('user/display_item/') ?>' + id);
	}
</script>