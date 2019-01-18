<?php

namespace app\controller;

use core\mvc\Controller;
use app\view\usuario\UsuarioView;
use app\dao\UsuarioDao;
use app\model\UsuarioModel;
use app\view\usuario\UsuarioList;
use core\mvc\view\Message;
use core\Application;
use core\util\Session;
use app\view\home\Home;
use core\dao\SqlObject;
use core\dao\Connection;

//..incluir a view de listagem.

final class UsuarioCtr extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = new UsuarioModel();
        $this->dao = new UsuarioDao();
        $this->view = new UsuarioView();
        $this->viewList = new UsuarioList();
    }

    public function viewToModel() {
        if ($this->post) {
            $this->model->setId($this->post['id']);
            $this->model->setNome($this->post['nome']);
            $this->model->setCpf($this->post['cpf']);
            $this->model->setEmail($this->post['email']);
            $this->model->setTelefone($this->post['telefone']);
            $this->model->setSenha($this->post['senha']);
        }
    }

    public function showList() {
        if ($this->post) {
            $this->criteria = "upper (" . UsuarioDao::COL_NAME . ") like upper('{$this->post['data'][0]}')";
            $this->orderBy = UsuarioDao::COL_NAME;
        }
        parent::showList();
    }

    /**
     * Cria uma sessão e armazena um objeto User model.
     * @return void
     */
    public function doLogin() {
        //..se houver no get uma variável nomeada method, então...
        if (isset($this->get['method'])) {
            $email = $this->post['email']; //..pega os dados do form
            $senha = $this->post['senha'];
            //..faz a busca de usuário baseado no e-mail e senha
            $activeUsuario = (new UsuarioDao())->findForLogin($email, $senha);
            if ($activeUsuario) { //..se encontrou, então...
                //..armazena o objeto model na sessão 'activeUser'
                Session::createSession('activeUsuario', $activeUsuario);
                //..vai para a página inicial
                (new Home())->show();
            } else {
                //..vai para a página inicial com msg de erro
                (new Home('Dados incorretos! Tente novamente.'))->show();
            }
        }
    }

    /**
     * Destrói a sessão 'activeUser', fazendo logout.
     * @return void
     */
    public function doLogout() {
        Session::destroySession('activeUsuario');
        Application::start();
    }

    /**
     * Insere um usuário e envia e-mail para que o cadastro seja validado. Note que esse método não precisaria ser implementado caso não tivesse que enviar o e-mail, pois ele é herdado da superclasse.
     * 
     */
    public function insertUpdate() {
        try {
            //..alimenta o model com os dados da View
            $this->viewToModel();
            //..seta o modelo atualizado no objeto DAO            
            $this->dao->setModel($this->model);
            //..invoca o método insertUpdate para persistir o Model - pega o id inserido
            $this->dao->insertUpdate();//deu pau aqui..
            //..cria uma view com mensagem de sucesso.
            $msg = new Message(
                    Application::MSG_TITLE_DEFAULT, Application::MSG_SUCCESS, Application::ICON_SUCCESS
            );
            //..cria o link para ativação do usuário
            $link = "http://localhost/Combos/Request.php?class=UsuarioCtr&method=activateUsuario&usuarioEmail={$this->model->getEmail()}";
            //..envia e-mail.
            $txt = "<h1>Combos</h1>";
            $txt .= "<p>Recebemos o seu cadastro! Clique no link abaixo para ativá-lo!</p>";
            $txt .= "<a href=\"$link\" target=\"_blank\">Clique Aqui!</a>";
            //..envia o email usando o método estática sendEmail da classe Application
            Application::sendEmail(
                    $this->model->getEmail(), Application::APP_NAME . " - Ativação (não responda)", $txt
            );
        } catch (Exception $ex) {
            $msg = new Message(
                    Application::MSG_TITLE_DEFAULT, Application::MSG_ERROR, Application::ICON_ERROR
            );
        } finally {
            $msg->show();
        }
    }

    /**
     * Método para ativar o usuário - ativado pel o link enviado ao e-mail do usuário
     */
    public function activateUsuario() {
        $msg = null;
        try {
            $email = $this->get['usuarioEmail']; //..pega o email
            $sqlObj = new SqlObject(Connection::getConnection()); //..cria um SqlObject
            //..executa uma atualização = update users set status_user = 'A'where email_user = $email 
            $sqlObj->update('usuario', /* array('status_usuario' => 'A'), */ "emailusuario = '{$email}' ");
            //.. cria uma página para msg de sucesso
            $msg = new Message(Application::MSG_TITLE_DEFAULT, 'Usuário ativado com sucesso! Faça o login!', null);
        } catch (\Exception $ex) {
            //..se der erro, cria uma página para msg de erro
            $msg = new Message(Application::MSG_TITLE_DEFAULT, Application::MSG_ERROR, null);
        } finally { //..mostra a msg
            $msg->show();
        }
    }
    
    public function checkEmail() {
        if (isset($this->get['method']) && isset($this->get['email'])) {
            $email = $this->get['email'];
            $emailExist = (new UsuarioDao())->findByEmail($email);
            echo json_encode($array['emailValido'] = !$emailExist >= 1);
        }
    }

}
