<?php  
	require("../_config/connection.php");

    $error = false;

    if(!$_GET || !$_GET["id"]){
        header('Location: index.php?message=Id do curso não informado!');
        die();
    }

    $cursoId = $_GET["id"];

    try {
        $query = "DELETE FROM curso WHERE id=$cursoId";
		$result = $conn->query($query);
        $conn->close();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    $message = ($result && !$error) ? "Curso excluido com sucesso." : "Erro ao excluir o curso.";
    header("Location: index.php?message=$message");
    die();

