<?php 

$idcliente = isset($_GET["idcliente"]) ? $_GET["idcliente"]:null;

echo $idcliente;

try {

    include('conexao.php');

    if($idcliente){

        //bucando os dados do cliente no bd
        $sql = "select * from tblclientes where idcliente= :idcliente"; 
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':idcliente', $idcliente);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_OBJ);

    }



if($_POST){

    if($_POST["idcliente"])

        $sql = "UPDATE tblclientes set (nome=:nome, email=:email) where idcliente = :idcliente";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":nome",$_POST["nome"]);
        $stmt->bindValue(":email",$_POST["email"]);
        $stmt->bindValue(":idcliente",$_POST["idcliente"]);
        $stmt->execute();

   } else {

        $sql = "insert into tblclientes  (nome,email) values (:nome,:email)";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":nome",$_POST["nome"]);
        $stmt->bindValue(":email",$_POST["email"]);  

        $stmt->execute(); 

   } 

   //header("Location:listarclientes.php");

  

} catch(PDOException $e){
    echo "erro".$e->getMessage;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Cadastro de Clientes</h1>
<form method="POST">
nome
<input type="text" name="nome" 
value="<?php echo isset($cliente)? $cliente->nome:null ?>">
email
<input type="text" name="email"
value="<?php echo isset($cliente)? $cliente->email:null ?>">

<input type="hidden" name="idcliente"
value="<?php echo isset($cliente)? $cliente->idcliente:null ?>">
<input type="submit">
</form>
</body>
</html>