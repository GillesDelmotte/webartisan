const burger = document.querySelector('.burger');

if (burger) {
    burger.onclick = function () {
        const filter = document.querySelector('.filter__input');
        filter.checked = false;
    };
}



const viewLoginPass = document.querySelector('.showPassword--login');

if (viewLoginPass) {
    viewLoginPass.onclick = function () {
        const input = document.querySelector('#passwordConnection');

        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
}


const viewRegisterPass = document.querySelector('.showPassword--register');

if (viewRegisterPass) {
    viewRegisterPass.onclick = function () {
        const input = document.querySelector('#passwordInscription');
        const input2 = document.querySelector('#passwordConfirm');

        if (input.type === 'password') {
            input.type = 'text';
            input2.type = 'text';
        } else {
            input.type = 'password';
            input2.type = 'password';
        }
    }
}

