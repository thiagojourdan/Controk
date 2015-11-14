function Cliente(){}
Cliente.prototype={
    constructor:Cliente,
    target:"cliente",
    data:function(action){
        return {
            target:this.target,
            action:action,
            id:$(".id").val(),
            nome:$(".nome").val(),
            cpf:format($(".cpf").val(),"cpf"),
            obs:$(".obs").val(),
            cargo:$(".cargo").val(),
            email:$(".email").val().toLowerCase(),
            telCel:format($(".telCel").val(),"telCel"),
            telFixo:format($(".telFixo").val(),"telFixo"),
            rua:$(".rua").val(),
            numero:$(".numero").val(),
            complemento:$(".complemento").val(),
            cep:format($(".cep").val(),"cep"),
            bairro:$(".bairro").val(),
            cidade:$(".cidade").val(),
            estado:$(".estado").val()
        };
    },
    exibirCampos:function(){
        /*
         * Tirar "col-lg-12" do ".row .container" e aplicar " col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1"
         */
        var content="<div class='panel panel-primary'>"+
            "<div class='panel-heading'>Cadastrar cliente</div>"+
            "<div class='panel-body'>"+
                "<div class='panel panel-default'>"+
                    "<div class='panel-heading'>Informações gerais</div>"+
                    "<div class='panel-body'>"+
                        "<div class='container col-md-6 col-xs-6'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>Nome</span>"+
                                "<input type='text' class='form-control nome'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-md-6 col-xs-6'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>CPF</span>"+
                                "<input type='text' class='form-control cpf'>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                "</div> <!-- Informações Gerais -->"+
                "<div class='panel panel-default'>"+
                    "<div class='panel-heading'>Contato</div>"+
                    "<div class='panel-body'>"+
                        "<div class='container col-lg-6 col-lg-offset-3 col-md-12 col-xs-12'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>E-mail</span>"+
                                "<input type='email' class='form-control email'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-md-6 col-xs-6'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>Tel. Cel.</span>"+
                                "<input type='text' class='form-control telCel'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-md-6 col-xs-6'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>Tel. Fixo</span>"+
                                "<input type='text' class='form-control telFixo'>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                "</div> <!-- Contato -->"+
                "<div class='panel panel-default'>"+
                    "<div class='panel-heading'>Endereço</div>"+
                    "<div class='panel-body'>"+
                        "<div class='container col-lg-4 col-lg-offset-2 col-md-6 col-xs-6'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>Log.</span>"+
                                "<select class='form-control logradouro' ng-model='logradouro'>"+
                                    "<option value='Rua'>Rua</option>"+
                                    "<option value='Av.'>Avenida</option>"+
                                    "<option value='Tv.'>Travessa</option>"+
                                "</select>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-lg-5 col-md-6 col-xs-6'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>{{logradouro}}</span>"+
                                "<input type='text' class='form-control log_nome'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-lg-2 col-xs-4'>"+
                            "<div class='form-group'>"+
                                "<input type='number' class='form-control numero' placeholder='Nº'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-lg-5 col-xs-8'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>Compl.</span>"+
                                "<input type='text' class='form-control complemento' placeholder='Casa, apartamento...'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-lg-5 col-md-4 col-xs-12'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>Bairro</span>"+
                                "<input type='text' class='form-control bairro'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-lg-4 col-md-4 col-xs-4'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>UF</span>"+
                                "<select class='form-control estado'>"+
                                    "<option selected>-</option>"+
                                    "<option value='CE'>CE</option>"+
                                    "<option value='MA'>MA</option>"+
                                "</select>"+
                            "</div>"+
                        "</div>"+
                        "<div class='container col-lg-8 col-md-4 col-xs-8'>"+
                            "<div class='form-group input-group'>"+
                                "<span class='input-group-addon'>Cidade</span>"+
                                "<select class='form-control estado'>"+
                                    "<option selected>-</option>"+
                                    "<option value='Fortaleza'>Fortaleza</option>"+
                                    "<option value='Juazeiro'>Juazeiro</option>"+
                                "</select>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                "</div> <!-- Endereço -->"+
            "</div>"+
        "</div>";
        return content;
    },
    cadastrar:function(){
        $.ajax({
            type:"post",
            data:this.data("cadastrar"),
            url:"php/manager.php",
            success: function(data){successCase(data,btnText);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    listar:function(){
        $.ajax({
            data:{
                target:this.target,
                action:"listar"
            },
            type:"post",
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type=="error"||obj.type=="success") successCase(data);
                else{
                    var content="",filter="";
                    if(obj.length!=0){
                        content="<table class='table'><thead><tr><th></th><th>Nome</th><th>CPF</th>"+
                        "<th><span class='glyphicon glyphicon-plus'></span></th><th></th></tr></thead><tbody>";
                        $.each(obj,function(i,item){
                            content+="<tr data-id='"+item.id+"'>"+
                            "<td class='check'><input type='checkbox'></td>"+
                            "<td class='nome'>"+item.nome+"</td>"+
                            "<td class='cpf'>"+format(item.cpf,"cpf")+"</td>"+
                            "<td class='maisInfo'><span class='glyphicon glyphicon-eye-open'></span></td>"+
                            "<td class='atualizar'><span class='glyphicon glyphicon-pencil'></span></td></tr>";
                        });
                        content+="</tbody></table>";
                        $.each([["nome","Nome"],["cpf","CPF"],["email","E-mail"]],function(i,a){
                            filter+="<div class='form-group col-md-12 col-ms-4 col-xs-"+(a[0]=="email"?12:6)+"'>"+
                                "<input type='text' class='form-control' data-search='"+a[0]+"' placeholder='"+a[1]+"'></div>";
                        });
                    }else{
                        content="<span>Não há clientes cadastrados.</span>";
                        filter="<span>Filtro indisponível.</span>";
                    }
                    showFading(listItems(filter,content));
                }
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    mostrarDados:function(trigger){
        $.ajax({
            type:"post",
            data:{
                id:$(trigger).parent().attr("data-id"),
                target:this.target,
                action:"mostrarDados"
            },
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data),
                text="<table class='table info'><tr><th>ID:</th><td>"+$(trigger).parent().attr("data-id")+"</td></tr>"+
                    "<tr><th>Obs.:</th><td>"+(obj.obs==""?"-":obj.obs)+"</td></tr>"+
                    "<tr><th>Email:</th><td>"+obj.email+"</td></tr>"+
                    "<tr><th>Celular:</th><td>"+format(obj.telCel,"telCel")+"</td></tr>"+
                    "<tr><th>Tel. Fixo:</th><td>"+format(obj.telFixo,"telFixo")+"</td></tr>"+
                    "<tr><th>Endereço:</th><td>"+obj.logradouro+" "+obj.log_nome+", "+(obj.numero==""?"S/N":obj.numero)+","+(obj.complemento==""?"":" "+obj.complemento)+", bairro "+obj.bairro+"</td></tr>"+
                    "<tr><th>Cidade:</th><td>"+obj.cidade+"/"+obj.estado+"</td></tr>"+
                    "<tr><th>CEP:</th><td>"+format(obj.cep,"cep")+"</td></tr></table>";
                var title="<span style='font-size:12pt'>"+$(".navbar-nav li.active a").html()+":</span><br>"+$(trigger).parent().find("td.nome").html();
                swal({
                    title:title,
                    text:text,
                    html:1
                });
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    buscarDados:function(){
        $.ajax({
            data:this.data("buscarDados"),
            type:"post",
            url:"php/manager.php",
            success: function(data){
                var obj=JSON.parse(data);
                if(obj.type==="error"||obj.type==="success") successCase(data,btnText);
                else{
                    content(this.target,"Atualização");
                    $(".id").val(obj.id);
                    $(".nome").val(obj.nome);
                    $(".cpf").val(format(obj.cpf,"cpf",0));
                    $(".obs").val(obj.obs);
                    $(".email").val(obj.email);
                    $(".telFixo").val(format(obj.telFixo,"telFixo"));
                    $(".telCel").val(format(obj.telCel,"telCel"));
                    $(".cep").val(format(obj.cep,"cep"));
                    $(".rua").val(obj.rua);
                    $(".numero").val(obj.numero);
                    $(".complemento").val(obj.complemento);
                    $(".bairro").val(obj.bairro);
                    $(".cidade").val(obj.cidade);
                    $(".estado").val(obj.estado);
                }
            },
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown,btnText,this.buscarDados);}
        });
    },
    atualizar:function(){
        $.ajax({
            type:"post",
            data:this.data("atualizar"),
            url:"php/manager.php",
            success: function(data){successCase(data);},
            error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
        });
    },
    excluir:function(){
        var num=0;
        $.each($("input:checked"),function(){num++;});
        swal({
            title:"Atenção!",
            text:"Você está prestes a excluir "+num+" cliente"+(num>1?"s":"")+".<br>Deseja continuar?",
            html:1,
            type:"warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },function(isConfirm){
            if(isConfirm){
                var idList=new Array();
                $.each($("input:checked"),function(){idList.push($(this).parent().parent().attr("data-id"));});
                $.ajax({
                    type:"post",
                    data:{
                        target:"cliente",
                        action:"excluir",
                        id:JSON.stringify(idList)
                    },
                    url:"php/manager.php",
                    success: function(data){
                        successCase(data);
                        $(".navbar-nav li.active").click();
                    },
                    error: function(jqXHR,textStatus,errorThrown){errorCase(textStatus,errorThrown);}
                });
            }
        });
    }
};