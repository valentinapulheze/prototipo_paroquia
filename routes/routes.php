<?php

$routes = [

    // Páginas públicas
    'home' => [
        'controller' => 'SiteController',
        'method' => 'index'
    ],

    'sobre' => [
        'controller' => 'SiteController',
        'method' => 'sobre'
    ],

    'contato' => [
        'controller' => 'SiteController',
        'method' => 'contato'
    ],

    'dizimo' => [
        'controller' => 'SiteController',
        'method' => 'dizimo'
    ],

    // Dashboard administrativo
    'dashboard' => [
        'controller' => 'AdminController',
        'method' => 'index'
    ],

    // Avisos públicos
    'avisos' => [
        'controller' => 'SiteController',
        'method' => 'avisos'
    ],

    'avisosPublicos' => [
        'controller' => 'SiteController',
        'method' => 'avisos'
    ],

    // Eventos antigos redirecionados para avisos
    'eventos' => [
        'controller' => 'SiteController',
        'method' => 'avisos'
    ],

    'eventosPublicos' => [
        'controller' => 'SiteController',
        'method' => 'avisos'
    ],

    // Loja
    'loja' => [
        'controller' => 'LojaController',
        'method' => 'loja'
    ],

    'listProduto' => [
        'controller' => 'LojaController',
        'method' => 'list'
    ],

    'saveProduto' => [
        'controller' => 'LojaController',
        'method' => 'save'
    ],

    'editProduto' => [
        'controller' => 'LojaController',
        'method' => 'edit'
    ],

    'deleteProduto' => [
        'controller' => 'LojaController',
        'method' => 'delete'
    ],

    // Avisos administrativos
    'aviso' => [
        'controller' => 'AvisoController',
        'method' => 'index'
    ],

    'novoAviso' => [
        'controller' => 'AvisoController',
        'method' => 'create'
    ],

    'saveAviso' => [
        'controller' => 'AvisoController',
        'method' => 'store'
    ],

    'editAviso' => [
        'controller' => 'AvisoController',
        'method' => 'edit'
    ],

    'atualizarAviso' => [
        'controller' => 'AvisoController',
        'method' => 'update'
    ],

    'deleteAviso' => [
        'controller' => 'AvisoController',
        'method' => 'delete'
    ],

    // Usuários
    'login' => [
        'controller' => 'UserController',
        'method' => 'login'
    ],

    'usuario' => [
        'controller' => 'UserController',
        'method' => 'list'
    ],

    'listUser' => [
        'controller' => 'UserController',
        'method' => 'list'
    ],

    'register' => [
        'controller' => 'UserController',
        'method' => 'register'
    ],

    'editUser' => [
        'controller' => 'UserController',
        'method' => 'edit'
    ],

    'deleteUser' => [
        'controller' => 'UserController',
        'method' => 'delete'
    ],

    'logout' => [
        'controller' => 'UserController',
        'method' => 'logout'
    ],

    'perfil' => [
        'controller' => 'UserController',
        'method' => 'editPerfil'
    ],

    'recuperaLogin' => [
        'controller' => 'UserController',
        'method' => 'recuperarSenha'
    ],

    'user/resetarSenha' => [
        'controller' => 'UserController',
        'method' => 'resetarSenha'
    ],

    'saveMassa' => [
        'controller' => 'UserController',
        'method' => 'importCsv'
    ],

    // Tokens
    'listToken' => [
        'controller' => 'TokenController',
        'method' => 'list'
    ],

    'saveToken' => [
        'controller' => 'TokenController',
        'method' => 'save'
    ],

    'editToken' => [
        'controller' => 'TokenController',
        'method' => 'edit'
    ],

    'deleteToken' => [
        'controller' => 'TokenController',
        'method' => 'delete'
    ],

    // Agendamento de confissões
    'agendamento' => [
        'controller' => 'AgendamentoController',
        'method' => 'index'
    ],

    'salvarAgendamento' => [
        'controller' => 'AgendamentoController',
        'method' => 'salvar'
    ],

    // Painel administrativo de agendamentos
    'painelAgendamento' => [
        'controller' => 'AgendamentoController',
        'method' => 'painel'
    ],

    'agenda' => [
        'controller' => 'AgendamentoController',
        'method' => 'painel'
    ],

    'cadastrarDisponibilidade' => [
        'controller' => 'AgendamentoController',
        'method' => 'cadastrarDisponibilidade'
    ],

    'bloquear' => [
        'controller' => 'AgendamentoController',
        'method' => 'bloquear'
    ],

    'liberar' => [
        'controller' => 'AgendamentoController',
        'method' => 'liberar'
    ],

    'cancelarAgendamento' => [
        'controller' => 'AgendamentoController',
        'method' => 'cancelar'
    ],

    // Erro 404
    'erro404' => [
        'controller' => 'ErrorController',
        'method' => 'erro404'
    ],

    
'detalheProduto' => [
    'controller' => 'LojaController',
    'method' => 'detalhe'
],

'padroeiro' => [
    'controller' => 'SiteController',
    'method' => 'padroeiro'
],
];