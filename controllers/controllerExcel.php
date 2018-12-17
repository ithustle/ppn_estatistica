<?php 
	
    require './../vendor/autoload.php';
    require "./../class/Conexao.php";
    require "./../class/Produtor.php";
    require "./../class/ProdutorDao.php";

    $fileName = "test.xlsx";
     
    $conexao = new Conexao();
    
    /** automatically detect the correct reader to load for this file type */
    $excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);

    //if we don't need any formatting on the data
    $excelReader->setReadDataOnly();

    //load only certain sheets from the file
    $loadSheets = array('teste');
    $excelReader->setLoadSheetsOnly($loadSheets);

    //the default behavior is to load all sheets
    $excelReader->setLoadAllSheets();   

    $excelObj = $excelReader->load($fileName);
    $excelObj->getActiveSheet()->toArray(null, true,true,true);

    $worksheetNames = $excelObj->getSheetNames($fileName);
    $return = array();
    
    foreach($worksheetNames as $key => $sheetName){
        //set the current active worksheet by name
        $excelObj->setActiveSheetIndexByName($sheetName);
        
        //create an assoc array with the sheet name as key and the sheet contents array as value
        $return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true,true,true);
    }
    
    //show the final array
    for ($i = 1; $i < count($return['teste']); $i++){
        inserir($conexao, $return['teste'][$i+1]['A'], $return['teste'][$i+1]['B'], $return['teste'][$i+1]['C']);
    }

    function inserir($conexao, $a, $b, $c) {

        $produtor = new Produtor($a, $b, $c, $a, $b);
        $dao = new ProdutorDao($conexao, $produtor);

        if ($dao->inserir()) {
        	echo "Feito";
        } else {
        	echo "Falhou";
        }
    }