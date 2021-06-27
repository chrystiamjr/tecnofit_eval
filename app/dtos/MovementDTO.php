<?php

namespace Tecnofit\Dto;

class MovementDTO extends BaseDTO {

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * MovementDTO constructor.
     * @param Object $movement
     */
    public function __construct($movement = null) {
        if(!is_null($movement)) {
            $this->id   = $movement->id;
            $this->name = $movement->name;
        }
    }

    /**
     * MovementDTO convert Movement model into DTO
     * @param Object $records
     * @return array
     */
    public function mapList($records) {
        $parsedArr = [];

        foreach($records as $row) $parsedArr[] = new MovementDTO($row);
        return $parsedArr;
    }
}