<?php
namespace app\model;

use core\mvc\Model;

class DoceModel extends Model
{

    private $descricaodoce;
    private $tipodoce;

    /**
     * DoceModel constructor.
     * @param $descricaodoce
     * @param $tipodoce
     */
    public function __construct(
            $id = null,
            $descricaodoce = null,
            $tipodoce = null)
    {
        parent::__construct($id);
        $this->descricaodoce = $descricaodoce;
        $this->tipodoce = $tipodoce;
    }

    /**
     * @return mixed
     */
    public function getDescricaoDoce()
    {
        return $this->descricaodoce;
    }

    /**
     * @param mixed $descricaodoce
     */
    public function setDescricaoDoce($descricaodoce)
    {
        $this->descricaodoce = $descricaodoce;
    }

    /**
     * @return mixed
     */
    public function getTipoDoce()
    {
        return $this->tipodoce;
    }

    /**
     * @param mixed $tipodoce
     */
    public function setTipoDoce($tipodoce)
    {
        $this->tipodoce = $tipodoce;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    public function show()
    {
        // TODO: Implement show() method.
    }
}