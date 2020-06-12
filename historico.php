
	<!DOCTYPE html>
<html>
<head>
	<?php include("conexao.php"); ?>
	<title></title>
<body style="background: #099">
	<div style="text-align: center;width: 100%;height: 5em;position: absolute;top: 010%; color: #fff;font-size: 24px">
		<span>Historico de actividades</span>
	</div>
	<div class="inseridos" style="margin-top: 10em">
		
			<div class="header" style="width: 100%;height: 4em;background-color: #333;border-top-right-radius: 10px;border-top-left-radius: 10px">
				<div class="dado" style="text-align: center; width: 33.2%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Data</span>
				</div>				
				<div class="dado" style="text-align: center; width: 33.2%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Accao</span>
				</div>				
				<div class="dado" style="text-align: center; width: 33.2%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Dado</span>
					</div>				
			</div>
			<?php 
				$select ="SELECT * FROM historico WHERE 1";
				$liSelect = mysqli_query($mysqli,$select);

				while($assoc = mysqli_fetch_assoc($liSelect)){
					$data = $assoc['data'];
					$dado = $assoc['dado'];
					$accao = $assoc['accao'];

			?>
			<div class="linha" style="border-bottom: 1px solid #fff;height: 3em">
				<div class="dado" style="text-align: center; width: 33.2%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;"><?php echo $data; ?></span>
				</div>				
				<div class="dado" style="text-align: center; width: 33.2%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;"><?php echo $accao; ?></span>
				</div>				
				<div class="dado" style="text-align: center; width: 33.2%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;"><?php echo $dado; ?></span>
				</div>				
			</div>
			<?php } ?>
	</div>
</body>
</html>
