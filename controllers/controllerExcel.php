<?php 
	
	require './../vendor/autoload.php';

 	$fileName = "test.xlsx";
 
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
        gravarContactos($cliente, $return['teste'][$i+1]['A'], $return['teste'][$i+1]['B'], $return['teste'][$i+1]['C']);
    }

    function conexao() {
		private $dsn = 'mysql:host=localhost;dbname=ppn_estatistica';
	    private $user = 'root';
	    private $pass = 'naoexiste';
	    private $cnn;
	    private $localhost;


	    public function __construct() {
	        try {
	            
	            if ($this->cnn == NULL){
	                
	                $cnn = parent::__construct($this->dsn, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	                    /*,PDO::MYSQL_ATTR_SSL_KEY    =>'/etc/mysql/ssl/client-key.pem',
	                    PDO::MYSQL_ATTR_SSL_CERT=>'/etc/mysql/ssl/client-cert.pem',
	                    PDO::MYSQL_ATTR_SSL_CA    =>'/etc/mysql/ssl/ca-cert.pem' 
	                    
	                    )*/));
	                $this->handle = $cnn;
	                
	                return $this->handle;
	            }
	            
	        } catch (PDOException $exc) {
	            
	            throw new Exception ("Mensagem: ". $exc->getMessage(). "Código de erro: ". $exc->getCode());
	            return FALSE;
	        }
	    }
    }

    function inserir() {
        $sqlLock = "LOCK TABLES contactos WRITE";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "INSERT INTO contactos (numero_telefone, telefone, nome, empresa) VALUES (:numero, :telefone, :nome, :empresa)";

        $this->conexao->beginTransaction();
        $this->conexao->exec($sqlLock);
        $exe = $this->conexao->prepare($sql);

        $exe->bindValue(':numero', $this->contacto->getNumeroDeTelefone());
        $exe->bindValue(':telefone', $this->contacto->getTelefone());
        $exe->bindValue(':nome', $this->contacto->getNomeDoContacto());
        $exe->bindValue(':empresa', $this->contacto->getEmpresaDoContacto());
        
        if (!$exe->execute()){
            $this->conexao->rollBack();
            print_r($exe->errorInfo()[2]);
        }else{
            $this->conexao->commit(); 
            $this->conexao->exec($sqlUnlock);
             
            return true;
        }
    }

    function eliminar() {
        $sqlLock = "LOCK TABLES contactos WRITE";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "DELETE FROM contactos;";
        conexao()->beginTransaction();
        conexao()->exec($sqlLock);
        $exe = conexao()->prepare($sql);
        
        if (!$exe->execute()){
            $this->conexao->rollBack();
            print_r($exe->errorInfo()[2]);
        }else{
            conexao()->commit(); 
            conexao()->exec($sqlUnlock);
             
            return true;
        }
    }