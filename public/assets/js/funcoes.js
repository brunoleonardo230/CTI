function load_page(caminho,value,id){
	caminho=caminho.concat(value);
	//alert(caminho);
	$('#'+id).load(caminho);
}


function load_page_post(caminho,value,id){
		$.ajax({
			type: "POST",
			url: caminho,
			data: value, //"busca="+stringbusca
			success: function(retorno){
				$('#'+id).empty().html(retorno);
			}
		});
	
}

function adicionar_item(){	
	var options = { 
		target:'#linkcart',	        
		url:'http://localhost/codeigniter/carrinho/adicionar',	        
		clearForm:false 
	}; 
	$("#form_carrinho_compras").ajaxSubmit(options); 
	return false;
}

function altera_carrinho(){
	var options = { 
	        target:'#carrinho',
	        sucess: atualizalinkcarrinho(),       
	        url:'http://localhost/codeigniter/carrinho/atualizar',	        
	        clearForm:false 
	    }; 
    $("#formcarrinho").ajaxSubmit(options); 
    return false;
}

function atualizalinkcarrinho(){
	$('#linkcart').load("http://localhost/codeigniter/carrinho/link_carrinho");
}