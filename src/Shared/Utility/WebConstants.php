<?php


namespace App\Shared\Utility;


class WebConstants
{
    const ROLE_ID = 1; // Role Student
    const IS_DISABLED = false; // User Disabled
    const IS_CHANGE_PASSWORD = false; // User is change password
    const IS_SEND_EMAIL = false;
    const ACTIVE = true;

    // Generate Password
    const PASSWORD_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Message User API
    const MSG_USER_VALIDATE = 'El correo electrónico ya se encuentra registrado';
    const MSG_USER_VALIDATE_IN_EDIT = 'El correo electrónico ya se encuentra registrado';
    const MSG_USER_ADD = 'El usuario se registro satisfactoriamente';
    const MSG_USER_EDIT = 'Los datos del usuario se actualizaron safisfactoriamente';
    const MSG_USER_CHANGE_PASSWORD = 'La contraseña se cambió correctamente';
    const MSG_USER_IS_DISABLED = 'El usuario fue deshabilitado correctamente';
    const MSG_USER_REMOVE = 'El usuario se eliminó correctamente';
    const MSG_USER_NOT_EXIST = 'El usuario no existe';

}