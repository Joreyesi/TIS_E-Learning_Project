<?php

namespace app\models; // Asegúrate de que el namespace sea correcto

use app\core\DbModel;
use app\core\UserModel;

/**
 * 
 * @package app/models
 */

class User extends UserModel
{
   

    public string $RUT_USUARIO = '';
    public string $NOMBRE = '';
    public string $APELLIDO = '';
    public string $CORREO = '';
    public string $REGION = '';
    public string $COMUNA = '';
    public int $ID_ROL = 3;

    public string $CONTRASENIA = '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'usuario';
    }
    public function primaryKey(): string
    {
        return 'ID';
    }

    public function save()
    {
   
        $this->CONTRASENIA = password_hash($this->CONTRASENIA, PASSWORD_DEFAULT);
        return parent::save();
    }
    public function rules(): array
    {
        return [
            'RUT_USUARIO' => [self::RULE_REQUIRED],
            'NOMBRE' => [self::RULE_REQUIRED],
            'APELLIDO' => [self::RULE_REQUIRED],
            'CORREO' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE,
                'class' => self::class,
                'attribute '
            ]],
            'CONTRASENIA' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'CONTRASENIA']],



        ];
    }
    public function attributes(): array
    {
        return ['RUT_USUARIO', 'NOMBRE','APELLIDO',  'CORREO', 'REGION', 'COMUNA', 'CONTRASENIA','ID_ROL'];
    }
    public function labels(): array
    {
        return [
            'RUT' => 'Rut',
            'NOMBRE' => 'Nombre',
            'APELLIDO' => 'Apellido',
            'CORREO' => 'Email',
            'REGION' => 'Region',
            'COMUNA' => 'Comuna',
            'CONTRASENIA' => 'Contraseña',
            'passwordConfirm' => 'Confirma tu contraseña',

        ];
    }
    public function getDisplayName(): string {
        return $this->NOMBRE;
    }
}
