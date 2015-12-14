<html><body>
<label id="title">Minesweeper</label>
<?php for($i = 1; $i<=8; $i++) :?>
	<?php for($j = 1; $j<=8; $j++) :?>
							<label id="cell-<?php echo $i ?>x<?php echo $j?>" class="any"></label>
						<?php endfor ?>
					<?php endfor ?>
							</body></html>