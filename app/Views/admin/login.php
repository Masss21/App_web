<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 50px; }
        .login-box { max-width: 400px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
        .error, .success { color: red; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>
    <p class="error" id="errorMsg"></p>

    <form id="formLogin">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#formLogin');
    const errorMsg = document.getElementById('errorMsg');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        errorMsg.textContent = '';

        const formData = new FormData(form);

        try {
            const response = await fetch('/admin/login-process', {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = '/admin'; // arahkan ke dashboard
            } else if (result.error) {
                errorMsg.textContent = result.error;
            }
        } catch (err) {
            errorMsg.textContent = 'Terjadi kesalahan, silakan coba lagi.';
        }
    });
});
</script>

</body>
</html>
