const loginBtn = document.getElementById('login-btn');
loginBtn.addEventListener('click', function (e) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    e.preventDefault();
    loginBtn.setAttribute('disabled','true');
    $.post('../controller/login.php', {username: username, password: password} , function (data, status) {
        data = JSON.parse(data);
        loginBtn.removeAttribute('disabled');
        if(data.success) {
            document.getElementById("categories-login").innerHTML = `
                <p>Chào ${username}</p>
                <image src=${data.avatarpath} alt="user-avatar" class="avatar"><br><br>`
        }
        else alert('Incorrect username or password');
    })
})

