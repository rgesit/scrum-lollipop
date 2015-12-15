<html>
<head>
	
	<script type="text/javascript">	
	function load(data){

		// data = [
  //       ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
  //       ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
  //       ['empty', 'empty', 'empty', 'empty', 'empty', 'bomb' , 'empty', 'empty'],
  //       ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
  //       ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
  //       ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
  //       ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
  //       ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
  //   	];	

    	for (var i =1; i<=8; i++){    		
    		for(var j=1; j<=8; j++){
    			document.getElementById("cell-"+i+"x"+j).innerHTML = data[i-1][j-1];
    		}
    	}
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
		<td onclick="check(<?php echo $i ?>, <?php echo $j ?>)"  id="cell-<?php echo $i ?>x<?php echo $j?>" class="">
		</td>
	<?php endfor ?>
	</tr>
<?php endfor ?>
</table>

<script type="text/javascript">
		load();
</script>
</body>
</html>