<?php

require_once('../config.php');
require_once(DBAPI);
require_once('../vendor/autoload.php');
require("logs.php");

use PHPMailer\PHPMailer\PHPMailer;

$customers = null;
$customer = null;

function index() {
	global $customers;
	$customers = find_all('customers');
}

function add() {

  if (!empty($_POST['customer'])) {
    $today = 
      date_create('now', new DateTimeZone('America/Sao_Paulo'));

    $customer = $_POST['customer'];
    $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
    $customer['input_file'] = $_FILES['input_file']['name'];
    
    $elementos = array_values($customer);
    $email = $elementos[0];
    
    $name_arq = $_FILES['input_file']['name'];
    $name_Temp = $_FILES['input_file']['tmp_name']; 
    
    save('customers', $customer);
    
    $arq_tem_con = convert_file($name_arq, $name_Temp);
    
    // Log
    $texto = "NOVO CADASTRO: [email]: ".$email." [arquivo]: ".$_FILES['input_file']['name']." foi cadastrado com sucesso!";
    logs($texto); 

    send_email($email, $arq_tem_con);
    download_file($arq_tem_con);
    header('location: ../index.php');
    clearstatcache();
  }
}

function view($id = null) {
  global $customer;
  $customer = find('customers', $id);
}
function delete($id = null) {

  global $customer;
  $customer = remove('customers', $id);

  $texto = "CASDATRO DELETADO: cadastro de [id]: ".$id." foi deletado!";
  logs($texto);
  header('location: index.php');
}

function edit() {

  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['customer'])) {

      $customer = $_POST['customer'];
      $customer['modified'] = $now->format("Y-m-d H:i:s");
      print_r(update('customers', $id, $customer));
      // LOG
      $texto = "ALTERAR CADASTRO: cadastro de [id]: ".$id." foi alterado!";
      logs($texto);
      header('location: index.php');
    } else {
        global $customer;
        $customer = find('customers', $id);
    } 
  } else {
    header('location: ../index.php');
  }
}

function convert_file($name_arq, $arquivo) {
    if(file_exists($arquivo)) {
    
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($arquivo);

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    
        $spreadsheet = $reader->load($arquivo);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Csv");
        $writer->setSheetIndex(0);   // Select which sheet to export.
        $writer->setDelimiter(',');  // Set delimiter.

        $file_out_csv = explode('.', $name_arq, 2)[0];
        
        $writer->save('../'.$file_out_csv.'.csv');
        $my_file = $file_out_csv.'.csv';
        
        $texto = "ARQUIVO CONVERTIDO: arquivo ".$name_arq." convertido para".$file_out_csv.".csv";
        logs($texto);
        return $my_file;
    }
}

function send_email($email, $arquivo) {
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    
    // Usuário da conta
    $mail->Username = 'username@email.com';
    // Senha da conta
    $mail->Password = 'senha_username';

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->IsHTML(true);

    $mail->setFrom('username@email.com', 'Smart Engine Solutions');

    $mail->addAddress($email, 'Cara(o) Cliente');
    $mail->Subject = 'Arquivo Convertido';

    $mail->Body = 'Olá! Segue o arquivo convertido em anexo.';
    
    if(isset($arquivo)){
        $mail->AddAttachment('../'.$arquivo, $arquivo);
        $texto = "EMAIL ENVIADO: novo email enviado para: ".$email;
        logs($texto);
    }
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        
    }
}

function download_file($arq_tem_con) { 
    if ( file_exists('../'.$arq_tem_con) ){
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$arq_tem_con.'"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');

        readfile('../'.$arq_tem_con);
        unlink('../'.$arq_tem_con);
        
        clearstatcache();  
    }    
}