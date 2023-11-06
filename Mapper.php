<?php


use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;

class Mapper extends HighloadController
{
    private string $entityName;
    private $entityDataClass;

    /**
     * @throws LoaderException
     * @throws SystemException
     */
    public function __construct($entityName)
    {
        parent::__construct($entityName);
        $this->entityName = $entityName;
        $this->init();
    }

    /**
     * @throws LoaderException
     * @throws SystemException
     * @throws Exception
     */
    private function init(): void
    {
        Loader::includeModule("highloadblock");

        $filter = array('=NAME' => $this->entityName);
        $hlblock = HL\HighloadBlockTable::getList(array('filter' => $filter))->fetch();

        if ($hlblock) {
            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $this->entityDataClass = $entity->getDataClass();
        } else {
            throw new \Exception("Highload block with name '{$this->entityName}' not found.");
        }
    }

    public function getById($id)
    {
        return $this->entityDataClass::getById($id)->fetch();
    }

    public function getList($filter = array(), $select = array()): array
    {
        $params = array(
            'select' => $select,
            'filter' => $filter,
        );

        $result = $this->entityDataClass::getList($params);

        $items = array();
        while ($item = $result->fetch()) {
            $items[] = $item;
        }

        return $items;
    }

    public function add($data)
    {
        $result = $this->entityDataClass::add($data);
        return $result->getId();
    }

    public function update($id, $data)
    {
        $result = $this->entityDataClass::update($id, $data);
        return $result->isSuccess();
    }

    public function delete($id)
    {
        return $this->entityDataClass::delete($id)->isSuccess();
    }
}
