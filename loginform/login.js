document.getElementById('show-signup').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('.login-form').classList.add('hidden');
    document.querySelector('.signup-form').classList.remove('hidden');
});

document.getElementById('show-login').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('.signup-form').classList.add('hidden');
    document.querySelector('.login-form').classList.remove('hidden');
});
