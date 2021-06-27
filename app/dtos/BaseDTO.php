<?php

namespace Tecnofit\Dto;

use JsonSerializable;

class BaseDTO implements JsonSerializable {

    /**
     * Serialize private attributes of the class
     * @return array
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}