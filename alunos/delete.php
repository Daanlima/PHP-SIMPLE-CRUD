<?php  
	require("../_config/connection.php");

    $error = false;

    if(!$_GET || !$_GET["id"]){
        header('Location: index.php?message=RM do aluno não informado!');
        die();
    }

    $alunoId = $_GET["id"];

    try {
        $query = "DELETE FROM aluno WHERE id=$alunoId";
		$result = $conn->query($query);
        $conn->close();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    $message = ($result && !$error) ? "Aluno excluido com sucesso." : "Erro ao excluir o aluno.";
    header("Location: index.php?message=$message");
    die();

