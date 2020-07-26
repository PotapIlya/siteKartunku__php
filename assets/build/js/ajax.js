if (document.querySelector('#register'))
{
    const register = document.querySelector('#register');
    register.onsubmit = async (e) =>
    {
        e.preventDefault();
        let response = await fetch('../../modules/register/register.php', {
            method: 'POST',
            body: new FormData(register)
        });
        if (response.ok)
        {
            let result = await response.json();
            console.log(result);
        }
        else{
            console.log('Errors...');
        }

    };
}
if (document.querySelector('#login'))
{
    const login = document.querySelector('#login');
    login.onsubmit = async (e) =>
    {
        e.preventDefault();
        let response = await fetch('../../modules/register/login.php', {
            method: 'POST',
            body: new FormData(login)
        });
        if (response.ok)
        {
            let result = await response.json();
            console.log(result);
        }
        else{
            console.log('Errors...');
        }

    };
}



if (document.querySelector('#personeCab'))
{
    const personeCab = document.querySelector('#personeCab');
    personeCab.onsubmit = async (e) =>
    {
        e.preventDefault();
        let response = await fetch('../../../modules/auth/persone/personeCab.php', {
            method: 'POST',
            body: new FormData(personeCab)
        });
       if (response.ok)
       {
           let result = await response.json();

           console.log(result)

           // let ishodnatyaStroka = result.image;
           // let obrezannayaStroka = ishodnatyaStroka.substring(0, ishodnatyaStroka.length-1);
           // console.log(obrezannayaStroka)

           if (result.image !== null)
           {
               const img = document.getElementById('personeImage');
               img.innerHTML = '<img class="w-100" src="/uploads/users/52/'+result.image+'" alt="">';
           }
       }
       else{
           console.log('Errors...');
       }
    };
}

if (document.querySelector('#personePict'))
{
    const personePict = document.querySelector('#personePict');
    personePict.onsubmit = async (e) =>
    {
        e.preventDefault();
        let response = await fetch('../../../modules/auth/persone/personePict.php', {
            method: 'POST',
            body: new FormData(personePict)
        });
        if (response.ok)
        {
            let result = await response.json();
            console.log(result);
            if (result.name !== '')
            {
                const ul = document.querySelector('.personePict__wrapper');
                ul.insertAdjacentHTML('beforeEnd', `
                    <div class="col-3">
                        <div class="personePict__item w-100">
                            <img class="w-100" src="/uploads/users/${result.id}/${result.name}" alt="">
                            <div data-image="${result.name}" class="personePictDelete personePict__delete">&#10008;</div>
                        </div>
                    </div>
                `);
            }
        }
        else{
            console.log('Ошибка загрузки картинки');
        }
    };
}
if (document.querySelector('.personePictDelete'))
{
    const personePictDelete = document.querySelectorAll('.personePictDelete');

    personePictDelete.forEach((btn) =>{

        btn.addEventListener('click', (event) => {
            event.preventDefault();
            const text = btn.getAttribute('data-image');
            const request = new XMLHttpRequest();
            const url = "../../../modules/auth/persone/personePictDelete.php";
            const params = "image=" + text;
            // console.log(params);

            request.responseType = "json";
            request.open("POST", url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                    let response = request.response;
                    // console.log(response);

                    btn.parentElement.parentElement.remove();
                }
            });

            request.send(params);
        });
    });
}




if (document.querySelector('.openTopImage'))
{
    const TopBox = document.querySelectorAll('.openModal ');
    TopBox.forEach((btn) =>{

        btn.addEventListener('click', (event) => {
            event.preventDefault();
            const text = btn.getAttribute('data-image');
            const url = "../../../modules/auth/openTopPage.php";
            const params = 'item=' + text;
            // console.log(params);

            const request = new XMLHttpRequest();
            request.responseType = "json";
            request.open("POST", url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                    let response = request.response;

                    console.log(response)

                    // document.querySelector('.title').textContent = response.id_user

                    const image = document.getElementById('openTopPageImage');
                    const text = document.getElementById('openTopPageText');
                    const btn = document.getElementById('openTopPageBtn');
                    const iDbtn = document.getElementById('idBtn');

                    image.innerHTML = `<img class="mw-100" src="/uploads/users/${response.id_user}/${response.image}" alt="">`;
                    text.innerHTML = `<span>${response.description}</span>`;
                    btn.innerHTML = `<a href="/pages/auth/infoPersone.php?${response.id_user}">Показать профиль</a>`;
                    iDbtn.innerHTML = `<input id="idBtn" name="id" type="hidden" value="${response.id}">Отправить</input>`;

                }
            });
            request.send(params);

            document.querySelector('.openTopImage').style.display = 'block';

        });
    });

    // const modal = document.getElementById('openTopImage_wrapper');
    const fullWindow = document.querySelector('.openTopImage');
    const fullWindowBody= document.querySelector('.openTopImage-box');


    window.addEventListener('click', (e) =>{
        if (e.target === fullWindowBody)
        {
            fullWindow.style.display = 'none';
        }
    });
}




if (document.querySelector('.topPersone__like'))
{
    const topPersoneLike = document.querySelectorAll('.topPersone__like');

    topPersoneLike.forEach((btn) =>{

        btn.addEventListener('click', (event) => {
            event.preventDefault();
            const text = btn.getAttribute('data-id');
            const request = new XMLHttpRequest();
            const url = "../../../modules/auth/like.php";
            const params = "id=" + text;
            // console.log(params);

            request.responseType = "json";
            request.open("POST", url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                    let response = request.response;

                    btn.querySelector('.countLike').textContent = response.likes;

                }
            });

            request.send(params);
        });
    });
}



const comments = document.querySelector('.comments');

comments.onsubmit = async (e) =>
    {
        e.preventDefault();
        let response = await fetch('../../modules/auth/comments.php', {
            method: 'POST',
            body: new FormData(comments)
        });
        if (response.ok)
        {
            let result = await response.json();
            console.log(result);
        }
        else{
            console.log('Errors...');
        }

    };



