<?php


use Bitrix\Main\ArgumentException;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

class Mapper extends HighloadController
{
    public function __construct($entityName)
    {
        parent::__construct($entityName);
    }

    /**
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function init(): void
    {
        parent::init();
    }


    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public function getById($id): bool|array
    {
        return $this->entityDataClass::getById($id)->fetch();
    }

    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
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

    /**
     * @throws Exception
     */
    public function add($data): array|int
    {
        $result = $this->entityDataClass::add($data);
        return $result->getId();
    }

    /**
     * @throws Exception
     */
    public function update($id, $data): bool
    {
        $result = $this->entityDataClass::update($id, $data);
        return $result->isSuccess();
    }

    /**
     * @throws Exception
     */
    public function delete($id): bool
    {
        return $this->entityDataClass::delete($id)->isSuccess();
    }
}
