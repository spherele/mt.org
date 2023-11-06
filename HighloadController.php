<?php

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HLBL;
use Bitrix\Main\Entity;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;


class HighloadController
{
    protected string $entityName;
    protected string|null|Entity\DataManager $entityDataClass = null;

    /**
     * @param $entityName
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function __construct($entityName)
    {
        $this->entityName = $entityName;
        $this->init();
    }

    /**
     * @throws LoaderException
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws Exception
     */
    protected function init(): void
    {
        try {
            Loader::includeModule("highloadblock");

            $filter = array('=NAME' => $this->entityName);
            $hlblock = HLBL\HighloadBlockTable::getList(array('filter' => $filter))->fetch();

            if ($hlblock) {
                $entity = HLBL\HighloadBlockTable::compileEntity($hlblock);
                $this->entityDataClass = $entity->getDataClass();
            } else {
                throw new \Exception("Highload block with name '{$this->entityName}' not found.");
            }
        } catch (LoaderException $e) {
            throw new LoaderException($e->getMessage());
        }
    }

    /**
     * Получение класса для работы со справочником
     * @return Entity\DataManager|null
     * @throws SystemException
     */
    protected function GetEntityDataClass() : ? string
    {
        try {
            return HLBL\HighloadBlockTable::compileEntity($this->entityName)->getDataClass();
        } catch (SystemException $systemException) {
            throw new SystemException($systemException->getMessage());

        }
    }

}




