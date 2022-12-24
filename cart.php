<?php 
   header("Content-Type: text/html; charset=ISO-8859-1");
   session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang='pt-br'>
<head>
  <title>store.com.br</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="store.css">
    <script language="javascript" src="store.js"></script>
    <meta name="description" content="Store - FDI {2AINFO}">
    <script src="js/store.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">

</head>

<body>
<a href="store.html" style="color:black"><header><h1><center>STORE</center></h1></header></a>

<div>
<a href="form.html"><img class='user' src="https://cdn-icons-png.flaticon.com/512/74/74472.png" ></img></a>
<a href="cart.html"><img class='cart' src='https://cdn-icons-png.flaticon.com/512/1374/1374128.png' align="right"></img></a>   
</div>
<main>

<center><input type="search" class="search" placeholder=" Search"></center>
<hr><br>
</main>
  <h2>Carrinho</h2>
     <form method="post" action="cart.php" name="cart" >
        <table cellpadding="5" cellspacing="8">
          <tr>
             <th width=20px> Item </th>
	     <th width=250px>Descricao</th>
	     <th width=100px>Preco</th>
	     <th width=50px>Quantidade</th>
          </tr>	  


<?php 
const LinhasPorPag = 5; 

function formata_linhas_tabela ($consulta, $pagina,&$qtd) {
    $numLinha = $pagina * LinhasPorPag;
    mysqli_data_seek($consulta, $numLinha);
    global $linhaTabela;
    for ($n = 0; $n < LinhasPorPag && 
         ($linha = mysqli_fetch_array($consulta)); $n++) {
	$descricao = $linha["descricao"];
	$preco = $linha["preco"];
	$id = $linha["id"];
	$q = IsSet($qtd[$id]) ? $qtd[$id] : 0;
	echo sprintf ($linhaTabela, $id, $descricao, $preco, $id, $q);
    }
}

function formata_botoes ($numPg, $pag) {
    echo "<br> pagina ".($pag+1)." de ".$numPg."&nbsp".
    //
       '<button value="sair" name="submit">Sair'.
       '</button> &nbsp'.
       '<button value="atualizar" name="submit">Atualizar'.
       '</button> &nbsp'.
       '<button value="comprar" name="submit">Comprar'.
       '</button> &nbsp';
    if ($pag > 0) 
	echo '<button value="prev" name="submit">'.
	     'Pg. Anterior</button> &nbsp'; 
    if ($pag < $numPg-1) 
       echo '<button value="prox" name="submit">Próxima Pg.</button>';
     echo"<br>\n";
}

function formata_total ($consulta, $qtd) {
    mysqli_data_seek($consulta, 0);
    $total = 0;
    while (($linha = mysqli_fetch_array($consulta, MYSQLI_ASSOC))) {
	$id = $linha["id"];
	if(!IsSet($qtd[$id]))  $qtd[$id] = 0.0;

	$total += $linha["preco"] * $qtd[$id];
    }
    echo "<br> Total : R\$" . sprintf ("%.2f",$total) . "<br>\n";
}
    
function pega_pagina ($numPaginas) {
    $pagina = IsSet($_SESSION["pagina"])?$_SESSION["pagina"]:0;
    if (IsSet($_POST["submit"])) {
	if ($_POST["submit"] == 'prox') 
	    $pagina = min($pagina+1,$numPaginas-1);
	if ($_POST["submit"] == 'prev') 
	    $pagina = max($pagina-1,0);
    }
    $_SESSION["pagina"] = $pagina;
    return $pagina;
}


function pega_quantidades () {
    $qtd = IsSet($_SESSION["qtd"]) ? $_SESSION["qtd"] : array();
    if (IsSet($_POST["qtd"])) {
	foreach ($_POST["qtd"] as $id => $q) {
	    $qtd [$id]=$q;
	}
    }
    $_SESSION["qtd"] = $qtd;
    return $qtd;
}


//$servidor = $_SERVER["REMOTE_ADDR"];
$conexao = mysqli_connect('localhost',"root","");

//verifica se a conexao foi bem sucedida
if(mysqli_connect_errno()){
   printf("Connect failed: %s\n", mysqli_connect_error());
} 

mysqli_select_db($conexao,"store");

$consulta = mysqli_query($conexao, "select * from produto");

$numPaginas = ceil(mysqli_num_rows($consulta)/LinhasPorPag);
$qtd = pega_quantidades ();
$pagina = pega_pagina ($numPaginas);

formata_linhas_tabela ($consulta, $pagina, $qtd);
echo "</table>";
formata_botoes ($numPaginas, $pagina);
formata_total ($consulta, $qtd);
mysqli_close($conexao);
?>

</form>
</body>
</html>