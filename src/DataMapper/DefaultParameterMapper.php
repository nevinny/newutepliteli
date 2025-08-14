<?php

namespace App\DataMapper;

use App\Entity\ProductVariant;
use App\Interface\ParameterMapperInterface;

class DefaultParameterMapper implements ParameterMapperInterface {
    public function getSizeData(ProductVariant $variant): ?array {
        $thickness = $width = $length = $packageQty = null;

        foreach ($variant->getParams() as $param) {
            switch ($param->getExternalId()) {
                case ProductParamTypes::THICKNESS:
                    $thickness = $param->getVal();
                    break;
                case ProductParamTypes::WIDTH:
                    $width = $param->getVal();
                    break;
                case ProductParamTypes::LENGTH:
                    $length = $param->getVal();
                    break;
                case ProductParamTypes::PACKAGE_QTY:
                    $packageQty = $param->getVal();
                    break;
            }
        }

        if (!$thickness || !$width || !$length) {
            return null;
        }

        return [
            'thickness' => $thickness,
            'width' => $width,
            'length' => $length,
            'packageQty' => $packageQty,
        ];
    }
}
