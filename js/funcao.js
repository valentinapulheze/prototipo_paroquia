function confirmaExclusaoUser(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteUser.php?id=" + id;
    }
}

function confirmaExclusaoCliente(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteClient.php?id=" + id;
    }
}

function confirmaExclusaoContact(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteContact.php?id=" + id;
    }
}

function confirmaExclusaoAbout(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteAbout.php?id=" + id;
    }
}

function confirmaExclusaoEnterprise(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteEnterprise.php?id=" + id;
    }
}

function confirmaExclusaoProduto(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteProduct.php?id=" + id;
    }
}

function confirmaExclusaoPedido(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteRequest.php?id=" + id;
    }
}

function confirmaExclusaoAbrirPedido(id) {
    if (confirm("Deseja Reabrir o Pedido de Personalizado?")) {
        window.location.href = "deleteRequestOpen.php?id=" + id;
    }
}

function confirmaExclusaoFecharPedido(id) {
    if (confirm("Deseja Fechar o Pedido de Personalizado?")) {
        window.location.href = "deleteRequestClose.php?id=" + id;
    }
}

function confirmaExclusaoFotos(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteFotos.php?id=" + id;
    }
}

function confirmaExclusaoReseller(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteReseller.php?id=" + id;
    }
}

function confirmaExclusaoNotifications(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteNotifications.php?id=" + id;
    }
}

function confirmaRevendedora(id, ativar_desativar) {
	console.log(ativar_desativar);
	const mensagem = ativar_desativar === 0 ? "Deseja candidatar/voltar para a função de revendedoras?" : "Deseja arquivar revendedora?";

	if (confirm(mensagem)) {
		if (ativar_desativar == 0) {
			ativar_desativar = 0;
		} else {
			ativar_desativar = 2;
		}
        window.location.href = `confReseller.php?id=${encodeURIComponent(id)}&ativar_desativar=${encodeURIComponent(ativar_desativar)}`;
    }
}

function confirmaAtivarDesativar(id, status) {
    const mensagem = status === 1 ? "Deseja desativar este registro?" : "Deseja ativar este registro?";
        
    if (confirm(mensagem)) {
		if (status == 0) {
			status = 1;
		} else {
			status = 0;
		}
        window.location.href = `configUser.php?id=${encodeURIComponent(id)}&status=${encodeURIComponent(status)}`;
    }
}

function confirmaResetarSenha(id, status) {
    if (confirm("Deseja resetar a senha do registro para 123?")) {
        window.location.href = "configUser.php?id=" + id + "&status=reset";
    }
}

function confirmaAtivarDesativarCliente(id, status) {
    const mensagem = status === 1 ? "Deseja desativar este registro?" : "Deseja ativar este registro?";
        
    if (confirm(mensagem)) {
		if (status == 0) {
			status = 1;
		} else {
			status = 0;
		}
        window.location.href = `configCliente.php?id=${encodeURIComponent(id)}&status=${encodeURIComponent(status)}`;
    }
}

function confirmaResetarSenhaCliente(id, status) {
    if (confirm("Deseja resetar a senha do registro para Fran@123?")) {
        window.location.href = "configCliente.php?id=" + id + "&status=reset";
    }
}

function confirmaExclusaoCategory(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteCategory.php?id=" + id;
    }
}

function confirmaExclusaoProduct(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteProduct.php?id=" + id;
    }
}

function confirmaExclusaoBriefcase(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteBriefcase.php?id=" + id;
    }
}

function confirmaExclusaoShopping(id) {
    if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteShopping.php?id=" + id;
    }
}

function confirmaExclusaoProduction(id) {
	if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteProduction.php?id=" + id;
    }
}

function confirmaExclusaoDelivery(id) {
	if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteDelivery.php?id=" + id;
    }
}

function confirmaExclusaoConsultaCPF(id) {
	if (confirm("Deseja excluir o registro?")) {
        window.location.href = "deleteCPFquery.php?id=" + id;
    }
}

function confirmaExclusaoRetornar(id) {
	if (confirm("Deseja reabrir a Maleta?")) {
        window.location.href = "restoreBriefcase.php?id=" + id;
    }
}

function confirmaExclusaoOrder(id, revendedora) {
	if (confirm("Deseja excluir o Pedido?")) {
        window.location.href = "deleteOrder.php?id=" + id + "&rev=" + revendedora;
    }
}

function confirmaExclusaoCatalog(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteCatalog.php?id=" + id;
    }
}

function confirmaRevendedoraUsuario(nome, whats, email) {
	if (confirm("Deseja Transformar Revendedoras em Usuários?")) {
        window.location.href = "transformaRevendedoraUsuario.php?nome=" + nome + "&whats= " + whats + "&email=" + email;
    }
}

function confirmaExclusaoUmDesejo(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteWishList.php?iddesejo=" + id;
    }
}

function confirmaExclusaoTudoDesejoCliente(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteWishList.php?idcliente=" + id;
    }
}

function confirmaExclusaoColors(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteColor.php?id=" + id;
    }
}

function confirmaExclusaoPlot(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deletePlot.php?id=" + id;
    }
}

function confirmaExclusaoMKT(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteMarketing.php?id=" + id;
    }
}

function confirmaAtivarDesativarMKT(id, status) {
    const mensagem = status === 1 ? "Deseja desativar este registro?" : "Deseja ativar este registro?";
        
    if (confirm(mensagem)) {
		if (status == 0) {
			status = 1;
		} else {
			status = 0;
		}
        window.location.href = `configMKT.php?id=${encodeURIComponent(id)}&status=${encodeURIComponent(status)}`;
    }
}

function confirmaExclusaoBeneficioInstallment(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteBenefitsInstallment.php?id=" + id;
    }
}

function confirmaExclusaoBenefitsShipping(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteBenefitsShipping.php?id=" + id;
    }
}

function confirmaExclusaoBenefitsWholesale(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteBenefitsWholesale.php?id=" + id;
    }
}

function confirmaExclusaoBenefitsPix(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deleteBenefitsPix.php?id=" + id;
    }
}

function confirmaExclusaoPromocao(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deletePromotions.php?id=" + id;
    }
}

function confirmaExclusaoPromocaoPorCategoria(id) {
	if (confirm("Deseja excluir o Item?")) {
        window.location.href = "deletePromotionsAll.php?id=" + id;
    }
}


/* ------- */

function OpcaoMensagens($id) {
	if($id === 1) {
		window.alert('Registro gravado com sucesso!');
	}
	if($id === 2) {
		window.alert('Erro ao salvar o arquivo. Aparentemente voc&ecirc; não tem permissão de escrita.');
	}
	if($id === 3) {
		window.alert('Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"');
	}
	if($id === 4) {
		window.alert('Registro já cadastrado!');
	}
	if($id === 5) {
		window.alert('Ocorreu um erro!');
	}
	if($id === 6) {
		window.alert('Registro alterado com sucesso!');
	}
	if($id === 7) {
		window.alert('Usuário e/ou senha inválido(s)!');
	}
	if($id === 8) {
		window.alert('Senhas não são iguais!');
	}
	if($id === 9) {
		window.alert('Registro excluido com sucesso!');
	}
	if($id === 10) {
		window.alert('Atenção!\nE-mail não encontrado em nosso cadastro.');
	}
	if($id === 11) {
		window.alert('CEP Inválido!');
	}
	if($id === 12) {
		window.alert('E-mail enviado com sucesso!');
	}
	if ($id === 13) {
		window.alert('E-mail enviado com sucesso!\nCaso não receba o e-mail verifique a pasta de Spam/Lixo Eletonico, ou \nEntre em contato com o site.');
	}
	if ($id === 14) {
		window.alert('Usuário Bloqueado!');
	}
	if($id === 15) {
		window.alert('Senha alterada com sucesso!');
	}
    if($id === 16) {
		window.alert('Atenção!\nA senha padrão, precisa ser alterada por questões de segurança.');
	}
}

function SessaoExpirada() {
	alert("WebSite diz: \nSua Sessão foi Expirada!");
}

function loginMensagem(){
    alert('Usuário e/ou senha invalido(s)!');
}

function logoff(){
    alert('Necessário fazer logout!');
}