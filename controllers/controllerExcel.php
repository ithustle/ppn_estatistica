<?php 
    set_time_limit(0);
    
    require './../vendor/autoload.php';
    require "./../class/Conexao.php";
    require "./../class/Produtor.php";
    require "./../class/Produto.php";
    require "./../class/ProdutorDao.php";
    require "./../class/ProdutoDao.php";

    $conexao = new Conexao();
        
    if (move_uploaded_file($_FILES['ficheiros']['tmp_name'][0], "../excel/" . $_FILES['ficheiros']['name'][0])) {
        extraiProdutores($conexao);
    }

    if (move_uploaded_file($_FILES['ficheiros']['tmp_name'][1], "../excel/" . $_FILES['ficheiros']['name'][1])) {
        extraiProdutos($conexao);
    }

    function extraiProdutores($conexao) {

        $fileName = "../excel/produtores.xlsx";

        $excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);
        $excelReader->setReadDataOnly();

        $loadSheets = array('produtores');
        $excelReader->setLoadSheetsOnly($loadSheets);

        $excelReader->setLoadAllSheets();   

        $excelObj = $excelReader->load($fileName);
        $excelObj->getActiveSheet()->toArray(null, true,true,true);

        $worksheetNames = $excelObj->getSheetNames($fileName);
        $return = array();
        
        foreach($worksheetNames as $key => $sheetName){
            $excelObj->setActiveSheetIndexByName($sheetName);
            $return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true,true,true);
        }
        
        //show the final array
        for ($i = 1; $i < count($return['produtores']); $i++){
            inserirProdutor($conexao, $return['produtores'][$i+2]['B'], $return['produtores'][$i+2]['E'], $return['produtores'][$i+2]['F'], $return['produtores'][$i+2]['G'], $return['produtores'][$i+2]['H']);
        }
    }

    function extraiProdutos($conexao) {

        $fileName = "../excel/produtos.xlsx";

        $excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);
        $excelReader->setReadDataOnly();

        $loadSheets = array('produtos');
        $excelReader->setLoadSheetsOnly($loadSheets);

        $excelReader->setLoadAllSheets();   

        $excelObj = $excelReader->load($fileName);
        $excelObj->getActiveSheet()->toArray(null, true,true,true);

        $worksheetNames = $excelObj->getSheetNames($fileName);
        $return = array();
        
        foreach($worksheetNames as $key => $sheetName){
            $excelObj->setActiveSheetIndexByName($sheetName);
            $return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true,true,true);
        }
        
        //show the final array
        for ($i = 1; $i < count($return['produtos']); $i++){
            inserirProdutos($conexao, $return['produtos'][$i]['A']);
        }
        echo true;
    }

    function inserirProdutor($conexao, $a, $b, $c, $d, $e) {

        $produtor = new Produtor($a, $b, $c, $d, $e );
        $dao = new ProdutorDao($conexao, $produtor);

        $dao->inserir();
    }

    function inserirProdutos($conexao, $a) {
        $produto = new Produto($a);
        $dao = new ProdutoDao($conexao, $produto);

        $dao->inserir();
    }