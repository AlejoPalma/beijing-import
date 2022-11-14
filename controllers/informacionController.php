<?php

class informacionController {

    public function politica_privacidad() {
        require_once 'views/informacion/politica_privacidad.php';
    }

    public function termino_condiciones() {
        require_once 'views/informacion/terminos_condiciones.php';
    }

    public function enviar() {
        if (isset($_POST)) {
            // Obtener los datos del cliente
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;

            if ($nombre && $mensaje && $email) {

                // Enviar Email
                // Datos para enviar el email
                $from = "mensajesWeb@beijingimport.net";
                $to = "contacto@beijingimport.net";
                $subject = "$nombre ha enviado un mensaje";
                $message = "$nombre envió el siguiente mensaje:\n\n";
                $message .= "$mensaje \n\n";
                $message .= "Email del cliente: $email\n";

                $headers = "From:" . $from;

                // Enviar Email
                $enviarMail = mail($to, $subject, $message, $headers);

                if($enviarMail) {
                    $_SESSION['mensaje'] = "complete";
                }else {
                    $_SESSION['mensaje'] = "false";
                }

                header('Location:' . base_url . '#mensaje');
            }
        } else {
            $_SESSION['mensaje'] = "false";
            header('Location:' . base_url . '#mensaje');
        }
    }

}
