<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php 
		include("conexao.php");
	?>
	<?php 
		if (isset($_POST['salvar'])) {
			$nome = $_POST['nome'];
			$endereco = $_POST['endereco'];
			$contacto = $_POST['contacto'];
			$sexo = $_POST['sexo'];
			$data = $_POST['data'];
			$insere = "INSERT INTO dados_pessoais (nome,endereco,data_nascimento,sexo,contacto) VALUES ('$nome','$endereco','$data','$sexo','$contacto') ";
			$insereSQLI = mysqli_query($mysqli,$insere);
			$historico = "INSERT INTO `historico` (`data`, `dado`, `accao`) VALUES (now(), '$nome', 'Inseriu usuario')";
			$lih = mysqli_query($mysqli,$historico);
			header("location:index.php");
		}

		if (isset($_GET['apagar'])) {
			$dado = $_GET['apagar'];
			$apagar = "DELETE FROM dados_pessoais WHERE id ='$dado'";
			$liApagar = mysqli_query($mysqli,$apagar);

			header("location:index.php?apaga=$dado");
		}

		
		if (isset($_GET['edita'])) {
			$dado = $_GET['edita'];
			$listar = "SELECT * FROM dados_pessoais WHERE id = '$dado' ";
					$listarSQLI = mysqli_query($mysqli,$listar);

					$dado = mysqli_fetch_assoc($listarSQLI);
						$nome = $dado['nome'];
						$contacto = $dado['contacto'];
						$endereco = $dado['endereco'];
						$data = $dado['data_nascimento'];
						$sexo = $dado['sexo'];
						$id = $dado['id'];
			?>
			<style>
						.all{display:none;background:#069}
				  </style>
				<form class="editaForm"  method="POST" action="#"
					 style="position: fixed;width: 35%;left: 30%;padding: 2.5%;border: 10px solid #fff;border-radius: 3px;outline: none;background-color: #fff;z-index: 10;top: 10em;">
					<input type="text" name="nome" placeholder="seu nome..." value="<?php echo $nome; ?>" maxlength="30" required=""><br/>
					<input type="endereco" name="endereco" placeholder="seu endereco..." maxlength="30" value="<?php echo $endereco; ?>" required=""><br/>
					<input type="number" name="contacto" placeholder="seu contacto..." maxlength="30" required="" value="<?php echo $contacto; ?>"><br/>
					<SELECT maxlength="30" required="" name="sexo">
						<option value="<?php echo $sexo ?>"><?php echo $sexo; ?></option>
						<option value="M" >M</option>
						<option value="F">F</option>
					</SELECT><br/>
					<input type="date" name="data" required="" value="<?php echo $data; ?>"><br/>
					<input type="submit" value="Salvar" name="alterar" />	
				</form>
		<?php
			if (isset($_POST['alterar'])) {
			$idApagar = $_GET['edita'];
			$nome = $_POST['nome'];
			$endereco = $_POST['endereco'];
			$contacto = $_POST['contacto'];
			$sexo = $_POST['sexo'];
			$data = $_POST['data'];
			$editar = "UPDATE dados_pessoais SET nome='$nome',endereco='$endereco',contacto='$contacto',data_nascimento='$data',sexo='$sexo' WHERE id ='$idApagar'";
			$alteraLi = mysqli_query($mysqli,$editar);
			$historico = "INSERT INTO `historico` (`data`, `dado`, `accao`) VALUES (now(), '$nome', 'Alterou usuario')";
			$lih = mysqli_query($mysqli,$historico);
			if ($alteraLi) {
				header("location:index.php?alterado=$idApagar");
			}
		}}
	?>
	<?php 
		if (isset($_GET['alterado'])) {
	?>
		<div style="position: fixed;width: 55%;height: 5em;background-color: #099;border-radius: 5px;left: 20%;top: 15%;text-align: center;"  id="alterado">
		<span style="color: #fff;font-weight: bold;font-size: 18px;position: relative; top: 35%">
			<?php 
				$idApagar = $_GET['alterado'];
				$listar = "SELECT * FROM dados_pessoais WHERE id = '$idApagar' ";
					$listarSQLI = mysqli_query($mysqli,$listar);

					$dado = mysqli_fetch_assoc($listarSQLI);
						$nome = $dado['nome']; 
					echo $nome;
			?> alterado com sucesso
		</span>
		</div>
	<?php } ?>
	<script type="text/javascript">
		function load(){
			document.getElementById("alterado").style.opacity="0.0";
			document.getElementById("alterado").style.transition="all 5s ease";

			document.getElementById("deletado").style.opacity="0.0";
			document.getElementById("deletado").style.transition="all 5s ease";
		}
	</script>
	<style type="text/css">
		body{text-align: center;background-color: #069;font-family: Microsoft JhengHei;font-size: 12px}
		.addButton{position: relative;float: left;width: 9em;height: 10em;background-color: #eee;text-align: center;top: 5em}
		.addButton img{position: relative;margin-top: 45%}
		.addButton span{position: absolute;bottom: 1em;width: 100%;left: 2%;font-size: 10px}
	 	.pesquisa{position: relative;float: right;margin-top: 8em;width: 27em}
	 	.pesquisa input[type="text"]{padding: 2.5%;position: relative;float: left;width: 15em;display: two;position: absolute;right: 1em}
	 	.pesquisa input[type="button"]{width: 10em;height: 3em; background-image: url("icon/search.png");background-repeat: no-repeat;background-position: center;background-color: unset;border: none;background-size:3em;position: absolute;right: -30px;cursor: pointer;display: none;}
		body .form input{padding: 1.5%;margin-bottom: 1em}
		body .form select{margin-bottom: 1em}
		body .form{position: fixed;width: 35%;left: 30%;padding: 2.5%;border: 10px solid #fff;border-radius: 3px;outline: none;background-color: #fff;z-index: 1;top: 10em;display: none;}
		 .editaForm{position: fixed;width: 35%;left: 30%;padding: 2.5%;border: 10px solid #fff;border-radius: 3px;outline: none;background-color: #fff;z-index: 10;top: 10em;}
		body .editaForm input{padding: 1.5%;margin-bottom: 1em}
		body .editaForm select{margin-bottom: 1em}
		.inseridos{position: relative;float: left;width: 100%;}
	</style>
</head>
<body onload="load()">
	<script type="text/javascript">
		function pesquisar(){
			document.getElementById("textoPesquisa").style.display="block";
			document.getElementById("textoPesquisa").style.width="15em";
			document.getElementById("textoPesquisa").style.right="1em";
			document.getElementById("textoPesquisa").style.transition="all 1s ease";
			document.getElementById("btnsearch").style.display="none";
		}
	</script>	

	<script type="text/javascript">
		function openAdd(){
			document.getElementById("form").style.display="block";
			document.getElementById("all").style.opacity="0";
			document.getElementById("all").style.transition="all 2s ease";
		}		
		function closeAd(){
			document.getElementById("form").style.display="none";
			document.getElementById("all").style.opacity="0.9";
			document.getElementById("all").style.transition="all 2s ease";
		}
	</script>
<div id="all" class="all">
	<div class="addButton" onclick="openAdd()" class="add">
		<img src="icon/add.png">
		<span>Adicionar Membro</span>
	</div>	
	<a href="historico.php">
		<div class="addButton" style="left: 2%" class="add">
			<img src="icon/add.png">
			<span>Ver Historico</span>
		</div>
	</a>
	<form class="pesquisa" action="#" method="POST">
				<input type="submit" name="pesquisar" style="display: none;">

		<input type="text" name="pesquisa" placeholder="pesquisa..." id="textoPesquisa">
		<input type="button" name="" onclick="pesquisar()" id="btnsearch">
		<?php 
			if (isset($_POST['pesquisar'])) {
				$pesquisa = $_POST['pesquisa'];
				header("location:pesquisa.php?pesquisa=$pesquisa");
				
			}
		?>
	</form>
	<div class="inseridos" style="margin-top: 10em">
		
			<div class="header" style="width: 100%;height: 4em;background-color: #333;border-top-right-radius: 10px;border-top-left-radius: 10px">
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Nome</span>
				</div>				
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Contacto</span>
				</div>				
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Endereço</span>
				</div>				
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Data de Nascimento</span>
				</div>				
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Sexo</span>
				</div>
				<div class="dado" style="width: 16.4%;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;">Operações</span>
				</div>
			</div>
			<?php 
					$listar = "SELECT * FROM dados_pessoais WHERE id > 0 ORDER BY nome ASC";
					$listarSQLI = mysqli_query($mysqli,$listar);

					while ($dado = mysqli_fetch_assoc($listarSQLI)) {
						$nome = $dado['nome'];
						$contacto = $dado['contacto'];
						$endereco = $dado['endereco'];
						$data = $dado['data_nascimento'];
						$sexo = $dado['sexo'];
						$id = $dado['id'];
				?>
			<div class="linha" style="border-bottom: 1px solid #fff;height: 3em">
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;"><?php echo $nome; ?></span>
				</div>				
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;"><?php echo $contacto; ?></span>
				</div>				
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;"><?php echo $endereco; ?></span>
				</div>				
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;"><?php echo $data; ?></span>
				</div>				
				<div class="dado" style="width: 16.4%;border-right: 1px solid #fff;height: 100%;position: relative;float: left;">
					<span style="top: 1em;color: #fff;font-weight: bold;position: relative;"><?php echo $sexo; ?></span>
				</div>				
				<div class="dado" style="width: 16.4%;height: 100%;position: relative;float: left;">
					<a href="index.php?apagar=<?php echo $id; ?>">
						<input type="button" name="" style="width: 3em;height: 3em; background-image: url('icon/delete.png'); background-repeat: no-repeat;background-position: center;background-color: unset;border: none;background-size: 2em">
					</a>
					<a href="index.php?edita=<?php echo $id; ?>">
						<input type="button" name="" style="width: 3em;height: 3em; background-image: url('icon/edit.png');background-repeat: no-repeat;background-position: center;background-color: unset;border: none;background-size: 2em" onclick="openAdd()">
					</a>
				</div>
			</div>
		<?php
		 }?>
	</div>

</div>
	<form method="POST" action="#" id="form" class="form">
		<input type="button" name="" value="X" style="width: 2em;height: 2em;border-radius: 30%;background-color: #ee4f4f;position: absolute;top: 0.2em;right: 0.2em;border: none;text-align: center;color: #fff" onclick="closeAd()">
		<input type="text" name="nome" placeholder="seu nome..." maxlength="30" required=""><br/>
		<input type="endereco" name="endereco" placeholder="seu endereco..." maxlength="30" required=""><br/>
		<input type="text" name="contacto" placeholder="seu contacto" maxlength="30" required=""><br/>
		<SELECT maxlength="30" required="" name="sexo">
			<option selected="" disabled="">selecionar sexo</option>
			<option value="M" >M</option>
			<option value="F">F</option>
		</SELECT><br/>
		<input type="date" name="data" maxlength="30" required=""><br/>
		<input type="submit" name="salvar" value="" style="background-image: url('icon/save.png');background-color: #fff; border: none;background-repeat: no-repeat;background-position: center;background-size: 2em;border-radius: 3px;width: 2.1em;padding: 3.5%; margin-left: 40%; float: left;margin-bottom: 2em">
		<input type="reset" name="" value="" style="background-image: url('icon/refresh.png');background-color: #fff; border: none;background-repeat: no-repeat;background-position: center;background-size: 2em;border-radius: 3px; width: 2.1em; padding: 3.5%;margin-left: 4%; float: left;margin-bottom: 2em">
			
	</form>
	<?php 
		if (isset($_GET['apaga'])) {
	?>
		<div style="position: fixed;width: 55%;height: 5em;background-color: #099;border-radius: 5px;left: 20%;top: 15%;text-align: center;"  id="deletado">
		<span style="color: #fff;font-weight: bold;font-size: 18px;position: relative; top: 35%">
			<?php 
				$idApagar = $_GET['apaga'];
				$listar = "SELECT * FROM dados_pessoais WHERE id = '$idApagar' ";
					$listarSQLI = mysqli_query($mysqli,$listar);

					$dado = mysqli_fetch_assoc($listarSQLI);
						$nome = $dado['nome']; 
					echo $nome;
			?> Removido com sucesso
		</span>
		</div>
	<?php } ?>

</body>
</html>