<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require 'HighloadController.php';

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\SystemException;
use Bitrix\Main\Entity;


class Order extends HighloadController
{

    public function __construct($entityName)
    {
        parent::__construct($entityName);
    }
    /**
     * Добавление записи в Highload-блок.
     *
     * @param array $data Данные для добавления.
     * @return AddResult
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws Exception
     */
    public function add(array $data): AddResult
    {
        $entityDataClass = $this->GetEntityDataClass();
        return $entityDataClass::add($data);
    }

    /**
     * Получение данных из Highload-блока с заданным фильтром.
     *
     * @param array $filter Фильтр для выборки данных.
     * @return array
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function get(array $filter = []): array
    {
        $entityDataClass = $this->GetEntityDataClass();
        $selectFields = ['ID', 'UF_NAME', 'UF_COUNT', 'UF_DATE', 'UF_CODE', 'UF_ACTIVE'];

        $query = new Entity\Query($entityDataClass);
        $query->setSelect($selectFields);
        $query->setFilter($filter);

        $result = $query->exec();
        return $result->fetchAll();
    }


}
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_after.php"); ?>
