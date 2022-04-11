<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
</head>
<body>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<section class="vh-200" style="background-color: #1b2029;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-15 col-md-8 col-lg-6 col-xl-10">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <?php 
$idos = isset($_GET["idos"]) ? $_GET["idos"]:null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 
try {
    $servidor= "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdavfinal";
    $con = new PDO ("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

    if($op=="del"){
        $sql = "DELETE FROM tblos where idos= :idos";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idos",$idos);
        $stmt->execute();
        header("location: listar.php");

    }

    if($idos){
        $sql = "SELECT * FROM tblos where idos=:idos";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idos",$idos);       
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_OBJ);
    }

    if($_POST){

        if($_POST["idos"]){
        $sql = "UPDATE tblos SET nomecliente = :nomecliente, nos = :nos, datareq = :datareq, datater = :datater, nomefun = :nomefun, nomestatus = :nomestatus, preco = :preco, where idos = :idos";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":nomecliente",$_POST["nomecliente"]);
        $stmt->bindValue(":nos",$_POST["nos"]);
        $stmt->bindValue(":datareq",$_POST["datareq"]);
        $stmt->bindValue(":datater",$_POST["datater"]);
        $stmt->bindValue(":nomefun",$_POST["nomefun"]);
        $stmt->bindValue(":nomestatus",$_POST["nomestatus"]);
        $stmt->bindValue(":preco",$_POST["preco"]);

        $stmt->bindValue(":idos",$_POST["idos"]);
        $stmt->execute();        

        } else {
            $sql = "INSERT INTO tblos (nomecliente,nos,datareq,datater,nomefun,nomestatus,preco) values(:nomecliente,:nos,:datareq,:datater,:nomefun,:nomestatus,:preco)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":nomecliente",$_POST["nomecliente"]);
            $stmt->bindValue(":nos",$_POST["nos"]);
            $stmt->bindValue(":datareq",$_POST["datareq"]);
            $stmt->bindValue(":datater",$_POST["datater"]);
            $stmt->bindValue(":nomefun",$_POST["nomefun"]);
            $stmt->bindValue(":nomestatus",$_POST["nomestatus"]);
            $stmt->bindValue(":preco",$_POST["preco"]);
            $stmt->execute();            
        }
            header("location: listaros.php");
    }
    
} catch(PDOException $e){
    echo "erro de conexão com o BD".$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Ordem de Serviços</title>
    </head>

    <body>
        <div class="container" class="border border-dark">
<!--
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="listaros.php">Clientes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="listarfuncionario.php">Funcionario</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="listardepart.php">Departamento</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="listarestoque.php">Estoque</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="listarvendas.php">Vendas</a>
                </li>        
                </ul>
            </div>
            </div>
        </nav>
        <hr>
-->
            <h1>Cadastro de Ordem de Serviços</h1><br>

            <form method="POST">                
                <div class="mb-3">
                <label for="entrada" >Nome do cliente</label><br>
                <input id="entrada"  type="text"      name="nomecliente"   value="<?php echo isset($orden) ? $orden->nomecliente :null ;?>"><br>
                </div>   
                
                <div class="mb-3">
                <label for="entrada" >Numero ordem </label><br>
                <input id="entrada"  type="text"      name="nos"       value="<?php echo isset($orden) ? $orden->nos :null ;?>"><br>
                </div>

                <div class="mb-3">
                <label for="entrada" >Data de requisição</label>
                <input id="entrada"  type="date"      name="datareq"  value="<?php echo isset($orden) ? $orden->datareq :null ;?>">
                </div>
                
                <div class="mb-3">
                <label for="entrada" >Data de termino </label>
                <input id="entrada"  type="date"     name="datater"     value="<?php echo isset($orden) ? $orden->datater :null ;?>">
                </div>

                <div class="mb-3">
                <label for="entrada" >Nome funcionario </label><br>
                <input id="entrada"  type="text"     name="nomefun"     value="<?php echo isset($orden) ? $orden->nomefun :null ;?>"><br>
                </div>

                <div class="mb-3">
                <label for="entrada" >Nome status </label><br>
                <input id="entrada"  type="text"     name="nomestatus"     value="<?php echo isset($orden) ? $orden->nomestatus :null ;?>"><br>
                </div>

                <div class="mb-3">
                <label for="entrada" >Preço </label><br>
                <input id="entrada"  type="text"     name="preco"     value="<?php echo isset($orden) ? $orden->preco :null ;?>"><br>
                </div>

                <input type="hidden"    name="idos" value="<?php echo isset($orden) ? $orden->idos :null ;?>"><br>
                <input type="submit" class="btn btn-outline-dark" value="Cadastar"><br>

            </form>
            <br>
            <a href="index.html" class="btn btn-outline-dark">Voltar</a>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>