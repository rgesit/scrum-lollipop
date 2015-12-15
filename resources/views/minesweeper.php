<html>
<head>
	
	<script type="text/javascript">	
	function load(){

	}

	function check(row, cell){
		cell = 'cell-'+row+'x'+cell;
		value = document.getElementById(cell).innerHTML;
			console.log(value.trim());
		
		if(document.getElementById(cell).innerHTML.trim() == 'bomb'){
			document.getElementById(cell).className = 'lost';		
		}else{
			console.log('Gak ada');
		}

	}
	</script>
</head>
<body>
<label id="title">Minesweeper</label>
<table border="1" class="grid">
<?php for($i = 1; $i<=8; $i++) :?>	
	<tr>
	<?php for($j = 1; $j<=8; $j++) :?>
		<td onclick="check(<?php echo $i ?>, <?php echo $j ?>)"  id="cell-<?php echo $i ?>x<?php echo $j?>" class="lost">
		</td>
	<?php endfor ?>
	</tr>
<?php endfor ?>
</table>
</body>
</html>