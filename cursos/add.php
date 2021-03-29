<?php
require("../_config/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Adicionar Curso</title>
</head>

<?php
$result = false;
$error = false;
if ($_POST) {
    try {
        $nome = $_POST["nome"];
        $description = $_POST["description"];
        $duracao = $_POST["duracao"];
        $sigla = $_POST["sigla"];

        $query = "INSERT INTO curso (
            nome,
            description,
            duracao,
            sigla
        ) VALUES (
            '$nome',
            '$description',
            '$duracao',
            '$sigla'
        )";
        
        
        $result = $conn->query($query);
        $conn->close();

        if ($result) {
            header('Location: index.php?message=Curso inserida com sucesso!');
            die();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<body>

    <?php
        readFile("../_partials/navbar.html");
    ?>

    <section class="container mt-5 mb-5">

        <?php if ($_POST && (!$result || $error)) : ?>
            <p>
                Erro ao salvar o novo curso.
                <?= $error ? $error : "Erro desconhecido." ?>
            </p>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col">
                <h1>Adicionar curso</h1>
            </div>
        </div>

        <form action="" method="post">

        <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea type="text" class="form-control" id="description" name="description"></textarea>
            </div>

            <div class="mb-3">
                <label for="duracao" class="form-label">Duração (em anos)</label>
                <input type="number" class="form-control" id="duracao" name="duracao" placeholder="Duração do curso">
            </div>

            <div class="mb-3">
                <label for="sigla" class="form-label">Sigla</label>
                <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla">
            </div>
            

            <a href="index.php" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>

        </form>
    </section>

</body>

</html>