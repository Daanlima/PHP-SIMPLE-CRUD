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
    <title>Editar curso</title>
</head>

<?php
$curso = false;
$error = false;

if (!$_GET || !isset($_GET["id"])) {
    header('Location: index.php?message=Id do curso não informado!');
    die();
}

$cursoId = $_GET["id"];

try {
    $query = "SELECT * FROM curso WHERE id=$cursoId";
    $result = $conn->query($query);
    $curso = $result->fetch_assoc();
    $result->close();
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (!$curso || $error) {
    header('Location: index.php?message=Erro ao recuperar dados do curso!');
    die();
}

$upadeError = false;
$updateResult = false;
if ($_POST) {
    try {
        $name = $_POST["nome"];
        $description = $_POST["description"];
        $duracao = $_POST["duracao"];
        $sigla = $_POST["sigla"];

        $query = "UPDATE curso SET 
            nome='$name', 
            description='$description',
            duracao='$duracao',
            sigla='$sigla'
        WHERE 
            id=$cursoId
        ";

        $updateResult = $conn->query($query);

        if ($updateResult) {
            header('Location: index.php?message=Curso alterado com sucesso!');
            die();
        }
    } catch (Exception $e) {
        $upadeError = $e->getMessage();
    }
}

$conn->close();

?>

<body>

    <?php
        readFile("../_partials/navbar.html");
    ?>

    <section class="container mt-5 mb-5">

        <?php if ($_POST && (!$updateResult || $upadeError)) : ?>
            <p>
                Erro ao alterar o curso.
                <?= $error ? $error : "Erro desconhecido." ?>
            </p>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col">
                <h1>Editar Curso</h1>
            </div>
        </div>

        <form action="" method="post">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do produto" value="<?= $curso["nome"] ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea type="text" class="form-control" id="description" name="description"><?= $curso["description"] ?></textarea>
            </div>

            <div class="mb-3">
                <label for="duracao" class="form-label">Duração (em anos)</label>
                <input type="number" class="form-control" id="duracao" name="duracao" placeholder="Duração do curso" value="<?= $curso["duracao"] ?>">
            </div>

            <div class="mb-3">
                <label for="sigla" class="form-label">Sigla</label>
                <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla" value="<?= $curso["sigla"] ?>">
            </div>

            <a href="index.php" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>

        </form>
    </section>

</body>

</html>