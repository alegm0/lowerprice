<body>
    <h1>Hola {{ $name }}</h1>
    <p>Se te envio un enlace para que puedas recuperar tu cuenta</p>
    <a href="http://localhost:3000/recover-password?token={{ $token }}" target="_blank">¡Click Aqui!</a>
</body>
