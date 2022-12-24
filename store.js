
function validateText(){
    var nome = formulario.nome.value;
    var email = formulario.email.value;
    var telefone = formulario.telefone.value;
    var senha= formulario.senha.value;
    var confirmeSenha = formulario.confirmeSenha.value;
    var cpf = formulario.cpf.value;
    var dtNascimento = formulario.dtNascimento.value;
    var sexo = formulario.sexo.value;
   
    if ((nome=="")&&(telefone=="")&&(email=="")&&(senha=="")&&(confirmeSenha=="")&&(dtNascimento=="")&&(sexo == false)){
        alert('Preencha o Formulário!');
    }
    else if ((nome=="")||(nome==null)||(/^\s+$/.test(nome))){
        alert("Nome Inválido!");
    }
    else if((telefone=="")||(telefone==null)||(/^\s+$/.test(telefone))||((telefone.length<11)||(telefone.length>11))){
        alert("Telefone Inválido! Ex: DD123456789")
    }
    else if((cpf.length<11)||(cpf.length>11)||(cpf=="")||(cpf==null)||(/^\s+$/.test(cpf))){
        alert("CPF Inválido! Não utilize pontuações!")
    }
    else if ((email=="")||(email==null)||(/^\s+$/.test(email))){
        alert("Email Inválido!")
    }
    else if((senha.length<8)||(senha=="")||(senha==null)||(/^\s+$/.test(senha))){
        alert("Senha Inválida! São necessários, no mínimo, 8 caracteres!")
    }
    else if((confirmeSenha!=senha)||(confirmeSenha=="")||(confirmeSenha==null)||(/^\s+$/.test(confirmeSenha))){
        alert("Senha e confirmação devem ser iguais!")
    }
    else if((dtNascimento=="")||(dtNascimento==null)){
        alert("Data de Nascimento Inválida!")
    }
    else if((sexo == false)){
        alert("Marque seu gênero!")
    }
    else{
        alert("Cadastro Concluído com Sucesso!")
    }
}   

function carrinho_gtx_1660_ti(){
    window.location = "cart.php"
    gtx_1660_ti()
}

