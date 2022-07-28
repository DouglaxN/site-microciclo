<?php
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$nascimento = $_POST['nascimento'];
$email = $_POST['email'];
$email2 = $_POST['emailc'];
$cel = $_POST['cel'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$rua = $_POST['rua'];
$bairro = $_POST['bairro'];
$formacao = $_POST['formacao'];
$uf = $_POST['uf'];
$titulo = $_POST['titulo'];
$tipo = $_POST['tipo'];
$comoSoube = $_POST['comoSoube'];

if(!isset($_POST['nome']) || !isset($_POST['email']) ){
	header('Location:index.html');
}

$mailInscrito = new PHPMailer(true);
$mailCoord = new PHPMailer(true);

if($email == $email2){
	// enviando para a organização
	try {
		$mailInscrito->isSMTP();
		$mailInscrito->CharSet = 'UTF-8';
		$mailInscrito->Host = 'smtp.gmail.com';
		$mailInscrito->SMTPAuth = true;
		$mailInscrito->Username = "lbmgmeta1@gmail.com";
		$mailInscrito->Password = "metaufrn01";
		$mailInscrito->Port = 587;

		$mailInscrito->setFrom('lbmgmeta1@gmail.com');
		$mailInscrito->clearAllRecipients();
		$mailInscrito->addAddress('lbmgmeta1@gmail.com');

		$mailInscrito->isHTML(true);
		$mailInscrito->Subject = 'Novo inscrito!';
		$mailInscrito->Body = '
						<h6>Nome: '.$nome.'</h6><br>'.'
						<h6>Email do inscrito: '.$email.'</h6><br>'.'
						<h6>Celular: '.$cel.'</h6><br>'.'
						<h6>Titulo: '.$titulo.'</h6><br>'.'
						<h6>tipo inscricao: '.$tipo.'</h6><br>'.'
						<h6>CPF: '.$cpf.'</h6><br>'.'
						<h6>data nascimento: '.$nascimento.'</h6><br>'.'				
						<h6>CEP: '.$cep.'</h6><br>'.'
						<h6>Endereco: '.$rua.'</h6><br>'.'
						<h6>bairro: '.$bairro.'</h6><br>'.'
						<h6>Cidade: '.$cidade.'</h6><br>'.'
						<h6>Estado: '.$uf.'</h6><br>'.'
						<h6>Como soube: '.$comoSoube.'</h6><br>'.'

					';
		$mailInscrito->AltBody = 'Novo inscrito no Curso!';

		$mailInscrito->send();

		} catch (Exception $e) {
		echo "Erro ao inscrever-se, por favor, contate o suporte do site.";
	}

	try {
		$mailCoord->isSMTP();
		$mailCoord->CharSet = 'UTF-8';
		$mailCoord->Host = 'smtp.gmail.com';
		$mailCoord->SMTPAuth = true;
		$mailCoord->Username = "lbmgmeta1@gmail.com";
		$mailCoord->Password = "metaufrn01";
		$mailCoord->Port = 587;
		
		$mailCoord->setFrom('lbmgmeta1@gmail.com');
		$mailInscrito->clearAllRecipients();
		$mailCoord->clearAddresses();
		$mailCoord->addAddress(''.$email.'');

		$mailCoord->isHTML(true);
		$mailCoord->Subject = 'Confirmação de Incrição - Curso Biorremediação';
		$mailCoord->Body = '
			
			<h4>Olá, <strong>'.$nome.'</strong>.</h4>
			<p>Sua inscrição para o Curso de Introdução à Biorremediação foi iniciada!</p> 
			<p> O link para participação no curso é https://meet.google.com/cft-tuik-bhi,
			mas sua participação só será liberada após efetuar o pagamento da taxa correspondente:<br><br>
			<strong>Graduação (R$ 25,00)</strong><br>
			<strong>Pós-graduação/Profissional (R$ 50,00)</strong>
			</p>
			<h5>Dados para transferência bancária:</h5>
			<p>Banco do Brasil:<br> 
				Agência: 3525-4 <br>
				Conta/Corrente: 117.223-9.
			</p> 
			<h5>ou</h5> 
			<p>PIX: 056.771.974-08 (CPF de Carolina Fonseca Minnicelli)</p>
			<h4>
				Favor enviar comprovante de transferência por e-mail lbmgmeta1@gmail.com até 48h após o preenchimento do formulário juntamente com o Atestado de matrícula ou Declaração de vínculo (Graduação).<br>
				Caso precise de ajuda, entre em contato por e-mail ou telefone (84) 98717-9698.
			</h4> 	';
		$mailCoord->AltBody = 'Confirmação de inscrição';

		if($mailCoord->send()) {
			header('Location:inscrito.html');
		} else {
			"Erro ao inscrever-se, por favor, contate o suporte do site.";
		}
	} catch (Exception $e) {
		"Erro ao inscrever-se, por favor, contate o suporte do site.";
	}		
}else{
	echo  "<h1>Não foi possível finalizar, o campo de Email e confirmação de Email estão diferentes! <br> 
	Por favor, retorne a página anterior e faça uma nova inscrição.</h1>";
}



?>