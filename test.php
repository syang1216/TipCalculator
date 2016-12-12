<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="form">
			<h1 style='text-align: center'> Tip Calclator </h1>
			<form class="style" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="row">
					<div class="cell-left">
						<label for="amount"> Bill subtotal: </label>
					</div>
					<div class="cell-right">
						$<input type="text" name="amount" value = <?php if(isset($_POST['amount'])) echo $_POST['amount']; ?> ><br></br>
					</div>
				</div>

				<div class="row">

				<div class="cell-left">
					<label for="percent"> Tip percentage: </br> </label>
				</div>

				<div class="cell-right">
				<?php

					for($i=10;$i<25;$i+=5){
						$percent = -1;
						if(isset($_POST['percent'])){
							$percent = $_POST['percent'];
						}
						if($percent == $i){
							echo "<input type='radio' name='percent' value= ' " . $i . "' checked>" . $i . "%";
						}else{
							echo "<input type='radio' name='percent' value= ' " . $i . "'>" . $i . "%";
						}
					}

					echo "</br>";
					if(isset($_POST['percent']) && (!strcmp($_POST['percent'], "custom"))){
						echo "<input type='radio' name='percent' value='custom' checked>";
						echo "custom <input type='text' name = 'custom_tip' style='width:60px' value = '". $_POST['custom_tip'] ."'>";
					}else{
						echo "<input type='radio' name='percent' value='custom'>";
						echo "custom <input type='text' name = 'custom_tip' style='width:60px'>";
					}
					echo "%</br></br></div>";
					echo "</div>";
					?>

					<div class='row'>
						<div class='cell-left'>
							split between 
						</div>
						<div class='cell-right'>
							<?php
								if(isset($_POST['split'])){
									echo "<input type='text' name='split' value='" . $_POST['split'] . "' style='width:30px'>";
								}else{
									echo "<input type='text' name='split' value='1' style='width:30px'>";
								}
							?>
							Persons
						</div>
					</div>
					</br>
					</br>

					<?php

					if(isset($_POST['submit']) && isset($_POST['amount']) && isset($_POST['percent']) && isset($_POST['split'])){
						$amount = $_POST['amount'];
						$percent = $_POST['percent'];
						$split = $_POST['split'];

						if(!strcmp($percent, "custom")){
							$percent = $_POST['custom_tip'];
						}


						echo "<div class='row' id='tip'>";
						echo "<div class ='cell-left'> </div>";
						echo "<div class ='cell-right'>";
						if($amount <= 0 || $percent <=0){
							echo "invalid amount or percent <br>";
						}else{
							$tip = (double)$amount * (double)$percent*0.01;
							echo "tip: " . $tip . "<br>";
							echo "total: " . ($tip + (double)$amount) . "<br>";
							
							if(!ctype_digit($split) || (int)$split < 1){
								echo "split between invalid number";
							}else{
								echo "tip each: ". $tip/$split . "</br>";
								echo "total each: " . ($tip + (double)$amount)/$split . "</br>";
							}
						}

						echo "</div>";
						echo "</div>";
					}
			    ?>

			    <input type="submit" value="submit" name="submit">
			</form>
		</div>
	</body>
</html>