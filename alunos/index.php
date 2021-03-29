<?php  
	require("../_config/connection.php");

	$message = false;
	$curso_id = false;

	if($_GET){
		if(isset($_GET["message"])){
			$message = $_GET["message"];
		}
		if(isset($_GET["curso_id"])){
			$curso_id = $_GET["curso_id"];
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<title>ALUNOS</title>

<style>
	.footer {
	position: relative;
	margin-top: -150px; /* negative value of footer height */
	height: 150px;
	clear:both;
	padding-top:20px;
	} 
</style>

</head>
<body>

	<?php  
        readFile("../_partials/navbar.html");
    ?>

	<?php 
		$query = "SELECT a.*, c.nome as curso 
			FROM aluno a
			INNER JOIN curso c on a.curso_id = c.id";

		if($curso_id){
			$query .= " WHERE a.curso_id = $curso_id";
		}

		$result = $conn->query($query);
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		$result->close();

		try {
			$cursoQuery = "SELECT * from curso";
			$cursoResult = $conn->query($cursoQuery);
		} catch (Exception $e) {
			header('Location: index.php?message=Erro ao recuperar lista de alunos!!');
			die();
		}
		
		$conn->close();
	?>
	<section class="container mt-5 mb-5">

		<?php if($message):?>
			<div class="alert alert-primary alert-dismissible fade show" role="alert">
				<?=$message?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endif;?>

		<div class="row mb-3">
			<div class="col">
				<h1>Alunos</h1>
			</div>
			<div class="col d-flex justify-content-end align-items-center">
				<a class="btn btn-primary" href="add.php">Adicionar</a>
			</div>
		</div>

		<form action="" method="get">
			<div class="input-group mb-3">
				<select 
					class="form-control" 
					id="curso_id" 
					name="curso_id">
						<option value></option>

						<?php while($curso = $cursoResult->fetch_assoc()): ?>
							<option 
								value="<?=$curso["id"]?>"
								<?= $curso["id"] == $curso_id ? 'selected' : '';?>
							>
								<?=$curso["nome"]?>
							</option>
						<?php endwhile; ?>
						
						<?php $cursoResult->close(); ?>
				</select>
				<button class="btn btn-outline-secondary" type="submit">
					Pesquisar
				</button>
			</div>
		</form>

		<table class="table table-striped table-bordered">
			<thead class="table-dark">
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>E-email</th>
					<th>Data de Nascimento</th>
					<th>Curso</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($rows as $aluno): ?>
					<tr>
						<td>
							<?=$aluno["id"]?>
						</td>
						<td>
							<?=$aluno["name"]?>
						</td>
						<td>
							<?=$aluno["email"]?>
						</td>
						<td>
							<?=$aluno["data_nascimento"]?>
						</td>
						<td>
							<?=$aluno["curso"]?>
						</td>
						<td>
							<div class="btn-group" role="group">
								<button 
									type="button" 
									class="btn btn-outline-primary"
									onclick="confirmDelete(<?=$aluno['id']?>)">
									Excluir
								</button>
								<a 
									href="edit.php?id=<?=$aluno["id"]?>" 
									class="btn btn-outline-primary">
									Editar
								</a>
								<a 
									href="view.php?id=<?=$aluno["id"]?>" 
									class="btn btn-outline-primary">
									Ver
								</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>

	<footer>
		<h4 class="text-center">POR: DANIEL, CATHARINA, MATHEUS CARDUZ E GARCIA =D</h4>
	</footer>
	
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script>
	const confirmDelete = (alunoId) => {
		const response = confirm("Deseja realmente excluir este registro de aluno?")
		if(response){
			window.location.href = "delete.php?id=" + alunoId
		}
	}
</script>
</html>


