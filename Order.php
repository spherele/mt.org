<?php
require 'HighloadController.php';

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;


class Order extends HighloadController
{

    public function __construct($entityName)
    {
        parent::__construct($entityName);
    }

    /**
     * Получение данных из Highload-блока с заданным фильтром.
     *
     * @param array $filter Фильтр для выборки данных.
     * @param array $select
     * @param array $order
     * @return array
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getList(array $filter = [], array $select = [], array $order = []): array
    {
        $params = [
            'select' => $select,
            'filter' => $filter,
            'order' => $order,
        ];

        $result = $this->entityDataClass::getList($params);

        $items = [];
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

