<?php
    $idImage = uniqid();
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $idImage.'.png');
?>

<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/download.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="../img/logo-page.png" />
    <title>Claus Sport - Sistema de Criação de Post</title>
</head>
<body onload="download()">

    <div class="fundo">
        <div class="aviso">
            <img src="img/load.gif">
            <p>Criando imagem</p>
        </div>
    </div>

    <div id="html-content-holder">
        <div class="post">
        <img id="img-upload" src="<?=$_POST["modelo"]?>">
        <?php if (($_POST["modelo"] == "../img/filtro_padrao.png") || ($_POST["modelo"] == "../img/filtro_promocao.png")) {?>
            <div class="textopreco">
                <p class="txtpreco">R$: <text id="txtpreco" class="txtpreco"><?=$_POST["precoAntigo"]?></text> </p>
            </div>
            <div class="textosku">
                <p class="txtsku">SKU: <text id="txtsku" class="txtsku"><?=$_POST["sku"]?></text> </p>
            </div>
        <?php } ?>
        <?php if ($_POST["modelo"] == "../img/filtro_promocao.png") {?>
            <div class="textopromocao">
                <p class="txtpromocao"><span class="promocao">PROMOÇÃO </span><br/>R$: <text id="txtpromocao" class="txtpromocao"><?=$_POST["precoNovo"]?></text></p>
            </div>
        <?php } ?>
        </div>
    </div>

    <script src="../libs/jquery-3.6.0.js" type="text/javascript"></script>
    <script src="../libs/html2canvas.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        // Disable scrolling.
        document.ontouchmove = function (e) {
        e.preventDefault();
        }
    
        $("#html-content-holder").css("background-image", "url(<? echo 'uploads/' . $idImage.'.png' ?>)");
        
        function download() {
            html2canvas(document.getElementById("html-content-holder"),{
                allowTaint: true,
                useCORS: true,
                scale:1
            }).then(function (canvas) {
                var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                var data = new Date();
                var dia = data.getDate();
                var mes = data.getMonth()+1;
                var ano = data.getFullYear();
                var hora = data.getHours();
                var minutos = data.getMinutes();
                var segundos = data.getSeconds();
                var dataCompleta = "Claus Image "+ano+"-"+mes+"-"+dia+" "+hora+"."+minutos+"."+segundos;
                anchorTag.download = dataCompleta+".jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
                var idImage = "<?php print $idImage.'.png'; ?>";
                window.location.href = 'clean.php?img='+idImage;
            });
        };
    </script>
</body>
</html>