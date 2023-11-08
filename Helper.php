<?php

class Helper
{
    public static function phpToJson($phpArray): void
    {
        $jsonData = json_encode($phpArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $filePath = 'data.json';

        if (file_put_contents($filePath, $jsonData) !== false) {
            echo "Данные успешно записаны в файл : ".$filePath;
            echo "<pre>";
               print_r($jsonData);
            echo "</pre>";

        } else {
            echo "Ошибка при записи данных в файл.";
        }

    }

    /**
     * @throws Exception
     */
    public static function jsonToPhp($filePath)
    {
        if (file_exists($filePath)) {
            $jsonContent = file_get_contents($filePath);
            if ($jsonContent !== false) {
                $phpArray = json_decode($jsonContent, true);
                if ($phpArray !== null) {
                    return $phpArray;
                } else {
                    throw new Exception("Ошибка при декодировании JSON.");
                }
            } else {
                throw new Exception("Ошибка при чтении файла JSON.");
            }
        } else {
            throw new Exception("Файл JSON не существует.");
        }
    }
}