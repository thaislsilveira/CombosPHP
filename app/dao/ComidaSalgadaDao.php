<?php

namespace app\dao;

use core\dao\Dao;
use app\model\ComidaSalgadaModel;

final class ComidaSalgadaDao extends Dao {

    const COL_ID = 'idcomidasalgada';
    const COL_DESCRICAO = 'descricaocomida';
    const COL_TIPO = 'tipocomida';

    public function __construct(ComidaSalgadaModel $model = null) {
        $this->model = is_null($model) ? new ComidaSalgadaModel() : $model;
        $this->tableName = 'combos.comidasalgada';
        $this->tableId = 'idcomidasalgada';
        $this->setColumns();
    }

    public function setColumns() {
        $this->columns = array(
            self::COL_DESCRICAO => $this->model->getDescricaoComida(),
            self::COL_TIPO => $this->model->getTipoComida()
        );
    }

     public function findById($id) {
        try {
            $data = parent::findById($id);
            if ($data) {
                return new ComidaSalgadaModel(
                        $data[self::COL_ID],
                        $data[self::COL_DESCRICAO],
                        $data[self::COL_TIPO]);
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
                    $list[] = new ComidaSalgadaModel($row[$this->tableId],
                            $row[self::COL_DESCRICAO], 
                            $row[self::COL_TIPO]);
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
