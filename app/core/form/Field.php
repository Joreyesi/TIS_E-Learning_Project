<?php

namespace app\core\form;

use app\core\Model;

/**
 * 
 * @package app\core\form
 */

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;
    public Model $model;
    public string $attribute;

    /**
     * @param \app\core\Model $model
     * @param string $attribute
     */

    public function __construct(\app\core\Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }
    public function __toString()
    {
        return sprintf(
            '
            <div class="form-group">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
            ',
            $this->model->getlabel($this->attribute),
            $this->type, // Tipo de input
            $this->attribute, // name del input debe ser el atributo (rut, nombre, etc.)
            $this->model->{$this->attribute}, // Valor actual del modelo
            $this->model->hasError($this->attribute) ? ' is-invalid' : '', // Si hay error, agregar clase is-invalid
            $this->model->getFirstError($this->attribute) // Mensaje de error si existe
        );
    }
    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
    public function dateField()
    {
        $this->type = 'date';
        return $this;
    }
}
