<html>
<head>
	<title>Minesweeper</title>
</head>
<body>

	<table border="1">
		<?php for($i= 1; $i<=8; $i++):?>
			<tr>
				<?php for($j= 1; $j<=8; $j++):?>
				<td
					<?php if($cell == $i && $row == $j) : ?>
							id="Minesweeper"			
					<?php else: ?>
						 id="cell-<?php echo $i?>x<?php echo $j ?>"
					<?php endif ?>
				>
				
				<?php if($cell == $i && $row == $j) : ?>
						<span id="Minesweeper">Minesweeper</span>
				<?php else:?>
				&nbsp;
				<?php endif ?>
				
				</td>
				<?php endfor ?>
			</tr>
		<?php endfor ?>
	</table>
</body>
</html>