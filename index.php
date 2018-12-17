<!DOCTYPE html>
<html>
<head>
	<title>Portal de Divulgação da Produção Nacional | Estatísticas</title>
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="cabeca">
        <div class="topo">
            <h3>Portal de Divulgação da Produção Nacional | Estatísticas</h3>
        </div>
        <nav class="menu">
            <nav class="content-admin">
                <div class="info">
                    <span>Área de administrador</span>
                </div>
                <button>Entrar</button>
            </nav>
        </nav>
    </header>
    <main class="corpo">
        <section class="caixa">
            <h3>Produtores</h3>
            <canvas id="produtores" width="80" height="80"></canvas>
        </section>
        <section class="caixa">
            <h3>Províncias</h3>
            <canvas id="provincia" width="80" height="80"></canvas>
        </section>
        <section class="caixa">
            <h3>Produtos</h3>
            <canvas id="produtos" width="80" height="80"></canvas>
        </section>
    </main>
    <footer>
    
    </footer>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
</body>
</html>