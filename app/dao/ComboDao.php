<?php

namespace app\dao;

use core\dao\Dao;
use app\model\ComboModel;
use app\model\UsuarioModel;
use app\model\BebidaModel;
use app\model\ComidaSalgadaModel;
use app\model\DoceModel;
use core\util\Strings;

final class ComboDao extends Dao {

    const COL_ID = 'idcombo';
    const COL_PRECOTOTAL = 'precototal';
    const COL_USUARIO = 'idusuario';
    const COL_BEBIDA = 'idbebida';
    const COL_COMIDASALGADA = 'idcomidasalgada';
    const COL_DOCE = 'iddoce';

    public function __construct(ComboModel $model = null) {
        $this->model = is_null($model) ? new ComboModel() : $model;
        $this->tableName = 'combos.combo';
        $this->tableId = 'idcombo';
        $this->setColumns();
    }

    public function setColumns() {
        $this->columns = array(
            self::COL_PRECOTOTAL => $this->model->getPrecoTotal(),
            self::COL_USUARIO => $this->model->getUsuario()->getId(),
            self::COL_BEBIDA => $this->model->getBebida()->getId(),
            self::COL_COMIDASALGADA => $this->model->getComidaSalgada()->getId(),
            self::COL_DOCE => $this->model->getDoce()->getId(),
        );
    }

    public function findById($id) {
        try {
            $data = parent::findById($id);
            if ($data) {
                $comboModel = new ComboModel();
                $comboModel->setId($data[$this->tableId]);
                $comboModel->setPrecoTotal($data[self::COL_PRECOTOTAL]);
                $usuarioDao = new UsuarioDao();
                //..cria uma nova instância de CityModel que recebe uma instância de CityDao
                $usuarioModel = $usuarioDao->findById($data[self::COL_USUARIO]);
                //..seta o CityModel no UserModel
                $comboModel->setUsuario($usuarioModel);

                $bebidaDao = new BebidaDao();
                //..cria uma nova instância de CityModel que recebe uma instância de CityDao
                $bebidaModel = $bebidaDao->findById($data[self::COL_BEBIDA]);
                //..seta o CityModel no UserModel
                $comboModel->setBebida($bebidaModel);

                $comidaSalgadaDao = new ComidaSalgadaDao();
                //..cria uma nova instância de CityModel que recebe uma instância de CityDao
                
                $comidaSalgadaModel = $comidaSalgadaDao->findById($data[self::COL_COMIDASALGADA]);
                //..seta o CityModel no UserModel
                $comboModel->setComidaSalgada($comidaSalgadaModel);

                $doceDao = new DoceDao();
                //..cria uma nova instância de CityModel que recebe uma instância de CityDao
                $doceModel = $doceDao->findById($data[self::COL_DOCE]);
                //..seta o CityModel no UserModel
                $comboModel->setDoce($doceModel);

                return $comboModel;
            } else
                return NULL;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function selectAll($criteria = null, $orderBy = null, $groupBy = null, $limit = null, $offSet = null) {
        try {
            $data = parent::selectAll($criteria, $orderBy, $groupBy, $limit, $offSet);
            if ($data) {
                $arrayList = array();
                foreach ($data as $reg) {
                    $arrayList[] = new ComboModel(
                            $reg[$this->tableId],
                            $reg[self::COL_PRECOTOTAL],
                            (new UsuarioDao())->findById($reg[self::COL_USUARIO]),
                            (new BebidaDao())->findById($reg[self::COL_BEBIDA]),
                            (new ComidaSalgadaDao())->findById($reg[self::COL_COMIDASALGADA]),
                            (new DoceDao())->findById($reg[self::COL_DOCE])
                    );
                }
                return $arrayList;
            } else
                return null;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
