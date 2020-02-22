<?php
// Função de Curl para puxar a pagina do AnimeQ
function curl($url) {
  $ch = @curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  $head[] = "Connection: keep-alive";
  $head[] = "Keep-Alive: 300";
  $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $head[] = "Accept-Language: en-us,en;q=0.5";
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');
  curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
  $page = curl_exec($ch);
  curl_close($ch);
  return $page;
}

  $urlSecao = $_POST['urlSecao'];
  $epinicio = $_POST['epinicio'];
  $epfinal  = $_POST['epfinal'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<div class="dadostexto">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Raspador AnimeQ Online</title>
  <style type="text/css">
body {
	background-color: #666;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#corpo {
	margin-top: 5px;
	margin-right: auto;
	margin-left: auto;
	width: 850px;
}
.dados1 {
	margin: 5px;
	float: left;
	width: 830px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFF;
	font-weight: bold;
	text-transform: uppercase;
}
.dadostexto {
	margin: 5px;
	float: left;
}
.campoexplicacao {
	float: left;
	margin-top: 11px;
	margin-right: 5px;
	margin-bottom: 11px;
	margin-left: 5px;
}
  #botao-gerador {
	margin-left: 35%;
	float: left;
}
  </style>
<SCRIPT LANGUAGE="JavaScript">
var copyTextareaBtn = document.querySelector('.copiar');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.textarea');
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'sim!' : 'não!';
    alert('Texto copiado? ' + msg);
  } catch (err) {
    alert('Opa, Não conseguimos copiar o texto, é possivel que o seu navegador não tenha suporte, tente usar Crtl+C.');
  }
});
</script>
  </head>
  <body>
  <form class="form-horizontal" id="form1" name="form1" method="post" action="raspadoranimeq.php">
    <div id="corpo">
      <div class="dados1">
        <div class="campoexplicacao">Url da seção</div>
        <div class="dadostexto">
          <label for="urlSecao"></label>
          <input name="urlSecao" type="text" id="urlSecao" size="100" />
        </div>
      </div>
<div class="dados1">
      <div class="campoexplicacao">Episódio Inicial</div>
      <div class="dadostexto"><input name="epinicio" type="text" id="epinicio" size="12" />
      </div>
      <div class="campoexplicacao">Episódio Final</div>
      <div class="dadostexto">
        <input name="epfinal" type="text" id="epfinal" size="12" />
      </div>
      <div class="dadostexto">
        <input type="submit" name="Gerar Links" id="Gerar Links" value="Gerar Links" />
      </div>
</div>
<div class="dados1">
  <label for="linksgerados"></label>
  <textarea name="linksgerados" id="input" cols="108" rows="20" class="textarea">
  <?php

// Verifica os valores postados para ver se todas as condições foram preenchidas
  if (!empty($urlSecao) and !empty(is_numeric($epinicio)) and !empty(is_numeric($epfinal))) {


// Aplica os dados em um Laço de repetição pegando os dados de todas as paginas existentes
  for ($i=$epinicio; $i <= $epfinal; $i++) {

if ($i <= 9) {
$html = curl($urlSecao.'-episodio-0'.$i.'/');
$buscarCodigo = explode('allowFullScreen data-rocket-lazyload="fitvidscompatible" data-lazy-src="', $html);
$buscarCodigo = explode('"></iframe>', $buscarCodigo[1]);
echo $buscarCodigo[0]."\n";

} else {

$html = curl($urlSecao.'-episodio-'.$i.'/');
$buscarCodigo = explode('allowFullScreen data-rocket-lazyload="fitvidscompatible" data-lazy-src="', $html);
$buscarCodigo = explode('"></iframe>', $buscarCodigo[1]);
echo $buscarCodigo[0]."\n";

}
}  
}

?>
  </textarea>

</div>
<div class="dados1">
  <div id="botao-gerador">
    <button id="copy-button" class="btn btn-default">SELECIONAR E COPIA TUDO</button>
  </div>
</div>
    </div>
    <script>
    var input  = document.getElementById("input");
    var button = document.getElementById("copy-button");

    button.addEventListener("click", function (event) {
        event.preventDefault();
        input.select();
        document.execCommand("copy");
    });
</script>
  </form>
  </body>
  </html>
