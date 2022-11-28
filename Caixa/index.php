<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="LuizChagaz">
    <title>Cadastro e Apresentação</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php 
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "Caixa";
        $valorF = 0;

        $conn = new PDO("mysql:dbname=$db; host=$host; charset=utf8", $user, $pass);

        $dados = $conn->query("SELECT entrada, saida, valor FROM Caixa");
    ?>
    <div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Entrada</th>
                    <th scope="col">Saida</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Valor atual</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach ($dados as $key => $value) {
                if($value["entrada"]== 1){
                $valorF = $valorF + $value["valor"];}elseif($value["saida"]== 1){
                    $valorF = $valorF - $value["valor"];}
                ?>
            <tr>
                <th style="<?php if($value["entrada"]== 1){ echo "background-color:green;";}else{echo "background-color:red;";}?>"></th>
                <th style="<?php if($value["saida"]== 1){ echo "background-color:green;";}else{echo "background-color:red;";}?>"></th>
                <th><?php echo $value["valor"]?></th>
                <th><?php echo ""?></th>
            </tr>
            <?php }?>
            <tr id="valorf">
                <th></th>
                <th></th>
                <th></th>
                <th id="valf"><?php echo $valorF;?></th>
            </tr>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
        Adicionar movimentação
    </button>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Movimentação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formi" method="POST">
        <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Valor</span>
  </div>
  <input id="val" name="valor" type="number" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>
<select id="movi" name="movimentacao" class="form-select" aria-label="Default select example">
  <option selected>Tipo de movimentação</option>
  <option value="entrada">Entrada</option>
  <option value="saida">Saida</option>
</select>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button id="entrar" type="button" class="btn btn-primary">Lançar</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script>
        $ = jQuery
        function addli(){

        }
        function pageload(){
            const buttons = document.querySelectorAll("#entrar")
            for (const button of buttons) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var form = document.querySelector("#formi");
                $.ajax({
                    url: "inserir.php",
                    method: "post",
                    data: $("#formi").serialize(),
                    dataType: "text",
                    success: function(){
                        var valo = document.querySelector("#val").value;
                        if(document.querySelector("#movi").options[document.querySelector("#movi").selectedIndex].text == "Entrada"){
                            cor1 = "green";
                            cor2 = "red";
                            valor = valo;
                        }else if(document.querySelector("#movi").options[document.querySelector("#movi").selectedIndex].text == "Saida"){
                            cor1 = "red";
                            cor2 = "green";
                            valor = "-" + valo;
                        }
                        var $valorf = document.querySelector("#valorf");
                        linha = "<tr><th style='background-color:"+ cor1 +" ;'></th><th style='background-color:"+ cor2 +" ;'></th><th>"+ document.querySelector("#val").value +"</th><th></th></tr>";
                        $valorf.insertAdjacentHTML('beforebegin', linha);
                        var valorf = parseInt(valor) + parseInt(document.querySelector("#valf").innerHTML); 
                        document.querySelector("#valf").textContent = valorf;
                    }
                })
            })
            }
        }
        window.onload = pageload;
    </script>
</body>
</html>