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
    <title>Visualizar aluno</title>
</head>

<?php
$aluno = false;
$error = false;

if (!$_GET || !isset($_GET["id"])) {
    header('Location: index.php?message=RM do aluno não informado!');
    die();
}

$alunoId = $_GET["id"];

try {
    $query = "SELECT a.*, c.nome as curso 
        FROM aluno a
        INNER JOIN curso c on a.curso_id = c.id
        WHERE a.id=$alunoId";

    $result = $conn->query($query);
    $aluno = $result->fetch_assoc();
    $result->close();
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (!$aluno || $error) {
    header('Location: index.php?message=Erro ao recuperar dados do produto!');
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
                <h1>Visualizar aluno</h1>
            </div>
        </div>

        <div class="mb-3">
            <h3>Nome</h3>
            <p><?= $aluno["name"] ?></p>
        </div>

        <div class="mb-3">
            <h3>E-mail</h3>
            <p><?= $aluno["email"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Data de nascimento</h3>
            <p><?= $aluno["data_nascimento"] ?></p>
        </div>


        <div class="mb-3">
            <h3>Curso</h3>
            <p><?= $aluno["curso"] ?></p>
        </div>
    </section>
</body>

</html>