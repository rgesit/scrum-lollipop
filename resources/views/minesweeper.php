<html>
<head>
	
	<script type="text/javascript">	
	function load(){

    	
	}

	function play(row, cell){
		cell = 'cell-'+row+'x'+cell;
		value = document.getElementById(cell).innerHTML;

		if(document.getElementById(cell).innerHTML.trim() == 'bomb' || document.getElementById(cell).getAttribute('data-bomb') == 'bomb'){
			document.getElementById(cell).className = 'lost';		
		}  else {
                document.getElementById('cell-'+x+'x'+y).className = 'safe';         
                //document.getElementById('cell-'+x+'x'+y).innerHTML = numBomb;
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
		<td onclick="play(<?php echo $i ?>, <?php echo $j ?>)"  id="cell-<?php echo $i ?>x<?php echo $j?>" class="">
		</td>
	<?php endfor ?>
	</tr>
<?php endfor ?>
</table>

</body>
</html>