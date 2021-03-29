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
    <title>Adicionar produto</title>
</head>

<?php
$result = false;
$error = false;


if ($_POST) {
    try {

        $name = $_POST["name"];
        $data_nascimento = $_POST["data_nascimento"];
        $email = $_POST["email"];
        $curso_id  = $_POST["curso_id"];

        $query = "INSERT INTO aluno (
            name, 
            data_nascimento, 
            email, 
            curso_id
        ) VALUES (
            '$name',
            '$data_nascimento', 
            '$email',
            $curso_id
        )";

        $result = $conn->query($query);
        $conn->close();

        if ($result) {
            header('Location: index.php?message=Aluno inserido com sucesso!');
            die();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

try {
    $cursoQuery = "SELECT * from curso";
    $cursoResult = $conn->query($cursoQuery);
} catch (Exception $e) {
    header('Location: index.php?message=Erro ao recuperar lista de cursos!!');
    die();
}

$conn->close();
?>

<body>

    <?php
        readFile("../_partials/navbar.html");
    ?>

    <section class="container mt-5 mb-5">

        <?php if ($_POST && (!$result || $error)) : ?>
            <p>
                Erro salvar o novo aluno.
                <?= $error ? $error : "Erro desconhecido." ?>
            </p>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col">
                <h1>Adicionar aluno</h1>
            </div>
        </div>

        <form action="" method="post">

            <div class="mb-3">
                <label for="curso_id" class="form-label">Curso</label>
                <select 
                    class="form-control" 
                    id="curso_id" 
                    name="curso_id"
                    required>
                        <option value></option>

                        <?php while($curso = $cursoResult->fetch_assoc()): ?>
                            <option value="<?=$curso["id"]?>">
                                <?=$curso["nome"]?>
                            </option>
                        <?php endwhile; ?>
                        
                        <?php $cursoResult->close(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do aluno" required>
            </div>

            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de nascimento:</label>
                <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="12/02/2001" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@email.com" required>
            </div>

            <a href="index.php" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>

        </form>
    </section>

</body>

</html>