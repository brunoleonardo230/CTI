// JavaScript Document

function Ajax(conexao,url,id)
{
	intFim = 100000;
	rand = "rand="+parseInt(Math.random()*intFim);
	if(url.indexOf("?") == -1) { url = url+"?"+rand; }
	else { url = url+"&"+rand; }
	document.getElementById(id).innerHTML = "<div style='text-align:center; width:100%;'><img src='path/img/ajax-loader.gif' /> Carregando...</div>";

	conexao.onreadystatechange = function() {
	

		if (conexao.readyState == 4)
		{
			if(conexao.status == 200) 
			{
				document.getElementById(id).innerHTML = conexao.responseText;
				extraiScript(conexao.responseText);
			} 
			else 
			{
				document.getElementById(id).innerHTML = "Houve um problema ao obter os dados:\n" + conexao.statusText;
			}
		}
	};

	conexao.open("GET", url, true);

	conexao.send(null);
}

function Cajax()
{
	return(GetRequest());
}
function GetRequest()
{
	Ajax_Request = null;
	if(window.XMLHttpRequest){
		// Inicializa o Componente XMLHTTP do Mozilla
		return(new XMLHttpRequest());
	// Caso ele não encontre, procura por uma versão ActiveX do IE 
	}else if(window.ActiveXObject){ 
		// Inicializa o Componente ActiveX para o AJAX
		return(new ActiveXObject("Microsoft.XMLHTTP"));
	}else{ 
		// Caso não consiga inicializar nenhum dos componentes, exibe um erro
		alert("Seu navegador não tem suporte a AJAX.");
	}
	return(Ajax_Request);
}

function extraiScript(texto){
//Maravilhosa função feita pelo SkyWalker.TO do imasters/forum
//http://forum.imasters.com.br/index.php?showtopic=165277&
    // inicializa o inicio ><
    var ini = 0;
    // loop enquanto achar um script
    while (ini!=-1){
        // procura uma tag de script
        ini = texto.indexOf('<script', ini);
        // se encontrar
        if (ini >=0){
            // define o inicio para depois do fechamento dessa tag
            ini = texto.indexOf('>', ini) + 1;
            // procura o final do script
            var fim = texto.indexOf('</script>', ini);
            // extrai apenas o script
            codigo = texto.substring(ini,fim);
            // executa o script
            //eval(codigo);
            /**********************
            * Alterado por Micox - micoxjcg@yahoo.com.br
            * Alterei pois com o eval não executava funções.
            ***********************/
            novo = document.createElement("script")
            novo.text = codigo;
            document.body.appendChild(novo);
        }
    }
}


var mes;
var ano;

function add_mes(ms) { mes = ms; selecionar_data(); }
function add_ano(an) { ano = an; selecionar_data(); }

function selecionar_data()
{
	Ajax(calendario,"path/ext/calenario/calendario.php?dtames="+mes+"&dtaano="+dtaano,"calendario");
}
