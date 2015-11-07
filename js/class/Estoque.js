function Estoque(){
    this.inserir=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                alvo: "estoque",
                idProduto: $(".idProduto").val(),
                qtdProd: $(".qtdProd").val()
            },
            url: "php/actions/inserir.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.cadastrar);}
        });
    };
    this.retirar=function(){
        var btnText=$(".goBtn").html();
        $(".goBtn").html("Aguarde...");
        $.ajax({
            type: "POST",
            data: {
                alvo: "estoque",
                idProduto: $(".idProduto").val(),
                idFuncionario: $(".idFuncionario").val(),
                dataSaida: $(".dataSaida").val(),
                qtdProd: $(".qtdProd").val()
            },
            url: "php/actions/retirar.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.cadastrar);}
        });
    };
    this.genFields=function(action){
        var container="";
        switch(action){
            case "Retirar": container+=generateField({id:"FuncEstq",type:"number",field:"idFuncionario",lblContent:"ID do funcionário"});
            case "Inserir": container+=generateField({field:"idProduto",type:"number",lblContent:"ID do produto"})+
            generateField({field:"qtdProd",type:"number",lblContent:"Quantidade do produto (un.)"})+
            generateField({id:"DataSaida",field:"dataSaida",lblContent:"Data Saída"});
        }
        return container;
    };
}