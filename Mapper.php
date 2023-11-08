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
}
