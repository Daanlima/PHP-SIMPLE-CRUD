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
    <title>Visualizar curso</title>
</head>

<?php
$curso = false;
$error = false;

if (!$_GET || !$_GET["id"]) {
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
    header('Location: index.php?message=Erro ao recuperar dados da categoria!');
    die();
}

$conn->close();

?>

<body>

    <?php
        readFile("../_partials/navbar.html");
    ?>

    <section class="container mt-5 mb-5">
        <div class="row mb-3">
            <div class="col">
                <h1>Visualizar curso</h1>
            </div>
        </div>

        <div class="mb-3">
            <h3>Nome</h3>
            <p><?= $curso["nome"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Descrição</h3>
            <p><?= $curso["description"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Duração (em anos)</h3>
            <p><?= $curso["duracao"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Sigla</h3>
            <p><?= $curso["sigla"] ?></p>
        </div>

    </section>
</body>

</html>