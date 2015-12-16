<html>
<head>
	
	<script type="text/javascript">	
	function load(){
    	
    	for(var i=0; i<= 7; i++){
    		for(var j=0; j<= 7; j++){
    			cell = 'cell-'+(i+1)+'x'+(j+1);
                    document.getElementById(cell).setAttribute('data-bomb', document.grid[i][j]);
    		}
    	}
	}

	function play(r, c){
		cell = 'cell-'+r+'x'+c;
		lmn = document.getElementById(cell);

		//if (lmn.className == 'safe') return;

		if (checkBomb(cell)){
			lmn.className = 'lost';
		}else{
		    lmn.className = 'safe';                         
            lmn.innerHTML = checkBombAround(r, c);
            lmn.textContent = checkBombAround(r, c);
		}		 
    }

    function checkBomb(cell){
		lmn = document.getElementById(cell);

		if(lmn.className == 'bomb' || 
			lmn.innerHTML.trim() == 'bomb' || 
			lmn.getAttribute('data-bomb') == 'bomb'){
			return true;
		}else{
			return false;
		}
    }
    
    function checkBombAround(row, cell){
    	var bombs = 0;
    	for(var i=row-1; i<= row+1; i++){
    		for (var j=cell-1; j<= cell+1; j++){
    			if(checkBomb('cell-'+i+'x'+j)){
    				bombs++;
    			}
    		}
    	}
    	if (bombs == 0){
    		bombs = '';
    	}
    	
    	return bombs;	    	
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