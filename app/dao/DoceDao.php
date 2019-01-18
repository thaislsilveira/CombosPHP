<?php

namespace app\dao;

use core\dao\Dao;
use app\model\DoceModel;

final class DoceDao extends Dao {

    const COL_ID = 'iddoce';
    const COL_DESCRICAO = 'descricaodoce';
    const COL_TIPO = 'tipodoce';
 

    public function __construct(DoceModel $model = null) {
        $this->model = is_null($model) ? new DoceModel() : $model;
        $this->tableName = 'combos.doce';
        $this->tableId = 'iddoce';
        $this->setColumns();
    }

    public function setColumns() {
        $this->columns = array(
            self::COL_DESCRICAO => $this->model->getDescricaoDoce(),
            self::COL_TIPO => $this->model->getTipoDoce()           
        );
    }

    public function findById($id)
    {
        try{
            $data = parent::findById($id);
            if($data){
                return new DoceModel(
                    $data[self::COL_ID],
                    $data[self::COL_DESCRICAO],
                    $data[self::COL_TIPO]);
            } else{
                return null;
            }
        } catch (\Exception $ex){
            throw $ex;
        }
    }

    public function selectAll($criteria = null, $orderBy = null,
                              $groupBy = null, $limit = null, $offSet = null)
    {
        try{
            $data = parent::selectAll($criteria, $orderBy, $groupBy,
                $limit, $offSet);
            if($data){
                $list = null;
                foreach($data as $row){
                    $list[] = new DoceModel($row[$this->tableId],
                        $row[self::COL_DESCRICAO],
                            $row[self::COL_TIPO]);
                }
                return $list;
            } else {
                return null;
            }
        } catch (\Exception $ex){
            throw $ex;
        }
    }

}
