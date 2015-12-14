<html>
<body>

	<table border="1">
		<?php for($i= 1; $i<=8; $i++):?>
			<tr>
				<?php for($j= 1; $j<=8; $j++):?>
				<td id="cell-<?php echo $i?>x<?php echo $j ?>">
				<?php if($cell == $i && $row == $j) : ?>
						Minesweeper
				<?php else : ?>
					&nbsp;
				<?php endif ?>
				</td>
				<?php endfor ?>
			</tr>
		<?php endfor ?>
	</table>
</body>
</html>