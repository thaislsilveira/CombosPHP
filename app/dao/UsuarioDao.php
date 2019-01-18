<?php

namespace app\dao;

use core\dao\Dao;
use app\model\UsuarioModel;
use core\dao\SqlObject;
use core\dao\Connection;
use app\dao\UsuarioDao;

final class UsuarioDao extends Dao {

    //..constantes para mapear colunas da tabela do bd
    const COL_NAME = 'nomeusuario';
    const COL_CPF = 'cpfusuario';
    const COL_EMAIL = 'emailusuario';
    const COL_TELEFONE = 'telefoneusuario';
    const COL_SENHA = 'senhausuario';
    const COL_ID = 'idusuario';

    public function __construct(UsuarioModel $model = null) {
        $this->model = is_null($model) ? new UsuarioModel() : $model;
        $this->tableName = 'combos.usuario'; //..nome da tabela
        $this->tableId = 'idusuario'; //..nome do campo de id
        $this->setColumns(); //..abstrato - deve ser codificado aqui!
    }

    //..pegar os dados do model (objeto) e criar um array...
    protected function setColumns() {
        $this->columns[self::COL_NAME] = $this->model->getNome();
        $this->columns[self::COL_CPF] = $this->model->getCpf();
        $this->columns[self::COL_EMAIL] = $this->model->getEmail();
        $this->columns[self::COL_TELEFONE] = $this->model->getTelefone();
        //..cria um hash md5 para armazenar a senha
        // $this->columns[self::COL_SENHA] = $this->model->getSenha();
        $this->columns[self::COL_SENHA] = \md5($this->model->getSenha());
    }

    public function findById($id) {
        try {
            /* esse método executa um 'select * from ... ' */
            $data = parent::findById($id);
            if ($data) { //..se retornar valor, então...
                /*
                  $userModel = new UserModel(
                  $data[$this->tableId],
                  $data[self::COL_NAME],
                  $data[self::COL_GENDER],
                  null, $data[self::COL_STATUS],
                  $data[self::COL_TYPE], $data[self::COL_EMAIL],
                  (new CityDao())->findById($data[self::COL_CITY])
                  ); */

                /* Obs: a palavra self:: faz referência à classe e é usada para acessar atributos estáticos e/ou constantes */

                $usuarioModel = new UsuarioModel();
                $usuarioModel->setId($data[$this->tableId]);
                //$userModel->setName($data['name_user']);
                $usuarioModel->setNome($data[self::COL_NAME]);
                $usuarioModel->setCpf($data[self::COL_CPF]);
                //$userModel->setPassword()
                $usuarioModel->setEmail($data[self::COL_EMAIL]);
                $usuarioModel->setTelefone($data[self::COL_TELEFONE]);

                return $usuarioModel;
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function selectAll(
    $criteria = null, $orderBy = null, $groupBy = null, $limit = null, $offSet = null
    ) {
        try {
            $data = parent::selectAll(
                            $criteria, $orderBy, $groupBy, $limit, $offSet
            );
            if ($data) {
                $arrayList = null;
                foreach ($data as $reg) {
                    $usuarioModel = new UsuarioModel(
                            $reg[$this->tableId], $reg[self::COL_NAME], $reg[self::COL_CPF], $reg[self::COL_EMAIL], $reg[self::COL_TELEFONE], $reg[self::COL_SENHA]
                    );
                    $arrayList[] = $usuarioModel;
                }
                return $arrayList;
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Busca um usuário por login e senha
     * @param string $login O email do usuário
     * @param string $pass A senha do usuário
     * @return UserModel
     */
    public function findForLogin($login, $pass) {
        try {
            $sqlObj = new SqlObject(Connection::getConnection());
            $criteria = self::COL_EMAIL . " = '{$login}' and ";
            $criteria .= self::COL_SENHA . " = md5('{$pass}')";
            // $criteria .= self::COL_SENHA . " = '{$pass}'";
            $usuario = $sqlObj->select($this->tableName, '*', $criteria);
            if ($usuario) {
                $usuario = $usuario[0]; //..pega a primeira posição do array
                return new UsuarioModel(
                        $usuario[$this->tableId], //..id do usuário
                        $usuario[self::COL_NAME], //..nome
                        $usuario[self::COL_CPF], //..cpf
                        null, //..senha
                        $usuario[self::COL_EMAIL], //..email
                        $usuario[self::COL_TELEFONE] //..telefone
                );
            } else
                return null;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function findByEmail($email) {
        try {
            if (isset($_SESSION['activeUsuario'])) {
                $id = $_SESSION['activeUsuario']->getId();
                return $data = parent::selectCount(self::COL_EMAIL . " = " . "'" . $email . "' and " . self::COL_ID . " <> " . $id);
            } else {
                return $data = parent::selectCount(self::COL_EMAIL . " = " . "'" . $email . "'");
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
