<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="LuizChagaz">
    <title>Cadastro e Apresentação</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-reboot.min.css">
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
        <table>
            <tr>
                <th>Entrada</th>
                <th>Saida</th>
                <th>Valor</th>
                <th>Valor atual</th>
</tr>
            <?php  foreach ($dados as $key => $value) {
                $valorF = $valorF + $value["valor"]?>
            <tr>
                <th><?php echo $value["entrada"]?></th>
                <th><?php echo $value["saida"]?></th>
                <th><?php echo $value["valor"]?></th>
                <th><?php echo ""?></th>
            </tr>
            <?php }?>
        </table>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script>
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
                    }
                })
            })
            }
        }
        window.onload = pageload;
    </script>
</body>
</html>