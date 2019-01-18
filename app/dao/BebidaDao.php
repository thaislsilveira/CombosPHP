<?php

namespace app\dao;

use core\dao\Dao;
use app\model\BebidaModel;

final class BebidaDao extends Dao {
    
    const COL_ID = 'idbebida';
    const COL_DESCRICAO = 'descricaobebida';
    const COL_TIPO = 'tipobebida';
    const COL_RECIPIENTE = 'recipiente';

    public function __construct(BebidaModel $model = null) {
        $this->model = is_null($model) ? new BebidaModel() : $model;
        $this->tableName = 'combos.bebida';
        $this->tableId = 'idbebida';
        $this->setColumns();
    }

    public function setColumns() {
        $this->columns = array(
            self::COL_DESCRICAO => $this->model->getDescricaoBebida(),
            self::COL_TIPO => $this->model->getTipoBebida(),
            self::COL_RECIPIENTE => $this->model->getRecipiente()
        );
    }

    public function findById($id) {
        try {
            $data = parent::findById($id);
            if ($data) {
                return new BebidaModel(
                        $data[self::COL_ID],
                        $data[self::COL_DESCRICAO],
                        $data[self::COL_TIPO], 
                        $data[self::COL_RECIPIENTE]);
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function selectAll($criteria = null, $orderBy = null, $groupBy = null, $limit = null, $offSet = null) {
        try {
            $data = parent::selectAll($criteria, $orderBy, $groupBy, $limit, $offSet);
            if ($data) {
                $list = null;
                foreach ($data as $row) {
                    $list[] = new BebidaModel($row[$this->tableId],
                            $row[self::COL_DESCRICAO], 
                            $row[self::COL_TIPO],
                            $row[self::COL_RECIPIENTE]);
                }
                return $list;
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
