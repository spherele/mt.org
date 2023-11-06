<?php

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HLBL;
use Bitrix\Main\Entity;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;


class HighloadController
{
    private $entityName;

    /**
     * @throws LoaderException
     */
    public function __construct($entityName)
    {

        $this->entityName = $entityName;

        try {
            Loader::includeModule("highloadblock");
        }catch (LoaderException $e){

            throw new LoaderException($e->getMessage());

        }
    }

    /**
     * @return mixed
     */
    public function getEntityName(): mixed
    {
        return $this->entityName;
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




