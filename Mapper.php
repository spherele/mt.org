<?php

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

class Mapper
{
    private $hlblockId;
    private $entityDataClass;

    public function __construct($hlblockId)
    {
        $this->hlblockId = $hlblockId;
        $this->init();
    }

    /**
     * @throws LoaderException
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws Exception
     */
    private function init(): void
    {
        Loader::includeModule("highloadblock");

        $hlblock = HL\HighloadBlockTable::getById($this->hlblockId)->fetch();

        if ($hlblock) {
            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $this->entityDataClass = $entity->getDataClass();
        } else {
            throw new \Exception("Highload блок с ID {$this->hlblockId} не найден.");
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
