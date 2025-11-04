<?php

namespace App\Service\Product;

class ParameterKeyMapper
{
    private const EXTERNAL_ID_MAP = [
        '284e5b42-8566-11ea-ab6b-001e671f818d' => 'thickness',
        'e1f77903-8566-11ea-ab6b-001e671f818d' => 'length',
        'b9d23e37-8566-11ea-ab6b-001e671f818d' => 'width',
        '1f68a117-8857-11ea-b94f-001e671f818d' => 'packageQty',
        'package' => 'packageType',
        '94daf23d-885b-11ea-b94f-001e671f818d' => 'type',
        '5891bb67-885d-11ea-b94f-001e671f818d' => 'baseMaterial',
        'c9f74146-885d-11ea-b94f-001e671f818d' => 'coatingMaterial',
        'c3e76665-8861-11ea-b94f-001e671f818d' => 'area',
        '106df5a6-f11b-11eb-951b-001e671f818d' => 'diameter',
        '132c9887-025d-11eb-9daf-001e671f818d' => 'grain',
        'units' => 'units',
        'ral' => 'ral',
        'color' => 'color',
    ];

    private const HUMAN_READABLE_NAMES = [
        'thickness' => 'Толщина',
        'length' => 'Длина',
        'width' => 'Ширина',
        'packageQty' => 'Количество в упаковке',
        'packageType' => 'Упаковка',
        'type' => 'Тип',
        'baseMaterial' => 'Материал основы',
        'coatingMaterial' => 'Материал покрытия верхней стороны',
        'area' => 'Площадь покрытия',
        'diameter' => 'Диаметр',
        'grain' => 'Зерно',
        'units' => 'Единицы',
        'ral' => 'RAL',
        'color' => 'Цвет',
    ];

    public function getKeyByExternalId(string $externalId): ?string
    {
        return self::EXTERNAL_ID_MAP[$externalId] ?? null;
    }

    public function getHumanReadableName(string $key): ?string
    {
        return self::HUMAN_READABLE_NAMES[$key] ?? null;
    }

    public function mapArrayKeys(array $params): array
    {
        $result = [];
        foreach ($params as $externalId => $value) {
            $key = $this->getKeyByExternalId($externalId);
            if ($key) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function getExternalIdMap(): array
    {
        return self::EXTERNAL_ID_MAP;
    }

    public function getHumanReadableNames(): array
    {
        return self::HUMAN_READABLE_NAMES;
    }

    public function getExternalIdByKey(string $key): ?string
    {
        return array_search($key, self::EXTERNAL_ID_MAP) ?: null;
    }

    public function getKeyByHumanReadableName(string $humanName): ?string
    {
        return array_search($humanName, self::HUMAN_READABLE_NAMES) ?: null;
    }

    /**
     * Возвращает массив для datalist в формате ['human_name' => 'external_id']
     */
    public function getDatalistOptions(): array
    {
        $options = [];
        foreach (self::HUMAN_READABLE_NAMES as $key => $humanName) {
            $externalId = $this->getExternalIdByKey($key);
            if ($externalId) {
                $options[$humanName] = $externalId;
            }
        }
        return $options;
    }
}
