<?php
// app/controllers/AuthController.php

class AuthController
{
    /* ============================
       Helper: bloquear registro
       ============================ */
    private function registrationDisabled()
    {
        // Opcional: podrías mostrar un mensaje, pero lo más limpio es mandar al login
        header("Location: index.php?c=auth&a=loginForm");
        exit;
    }

    /* ============================
       Login (formulario)
       ============================ */
    public function loginForm()
    {
        $error = $_GET['error'] ?? null;
        require __DIR__ . '/../views/auth/login.php';
    }

    /* ============================
       Login (procesa POST)
       ============================ */
    public function login()
    {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            header("Location: index.php?c=auth&a=loginForm&error=Datos+incompletos");
            exit;
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            header("Location: index.php?c=auth&a=loginForm&error=Credenciales+incorrectas");
            exit;
        }

        // Login OK
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name']  = $user['nombre'];

        header("Location: index.php?c=admin&a=createPerfumeForm");
        exit;
    }

    /* ============================
       Logout
       ============================ */
    public function logout()
    {
        $_SESSION = [];
        if (session_id() !== '' || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        session_destroy();

        header("Location: index.php?c=auth&a=loginForm");
        exit;
    }

    /* ============================
       Registro (formulario) DESHABILITADO
       ============================ */
    public function registerForm()
    {
        // Nadie más puede registrarse, ni con link directo
        $this->registrationDisabled();
    }

    /* ============================
       Registro (procesar POST) DESHABILITADO
       ============================ */
    public function register()
    {
        // Bloqueado también si alguien manda un POST directo
        $this->registrationDisabled();
    }
}
