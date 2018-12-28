<!DOCTYPE html>
<html>
<head>
	<title>Portal de Divulgação da Produção Nacional | Estatísticas</title>
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="fundo"></div>
    <div id="painel_insercao">
        <h3>Fonte de Dados</h3>
        <section>
            <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="ficheiros[]" id="ficheiros" multiple />
            <input type="password" id="senha" placeholder="Palavra-passe" />
            <div id="contentButton"></div>
        </section>
    </div>
    <header class="cabeca">
        <div class="topo">
            <h3>Portal de Divulgação da Produção Nacional | Estatísticas</h3>
        </div>
        <nav class="menu">
            <nav class="content-admin">
                <div class="info">
                    <span>Área de administrador</span>
                </div>
                <button onclick="entrar()">Entrar</button>
            </nav>
        </nav>
    </header>
    <main class="corpo">
        <section class="caixa">
            <h3>Províncias</h3>
            <canvas id="provincia" width="90" height="80"></canvas>
        </section>
        <div id="chartContainer" style="height: 500px; width: 100%;"></div>
        <footer class="marquee"></footer>
    </main>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</body>
</html>