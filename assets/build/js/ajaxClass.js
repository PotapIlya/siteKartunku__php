class Ajax
{
    constructor(form, url)
    {
        this.url = url;
        this.form   = document.querySelector(form);
    }

    initButton()
    {
    
    }

    init()
    {
        const input = this.form.querySelectorAll('input');
        const btn   = this.form.querySelector('button');
        // console.log(input)
        this.start(input, btn);
    }

    start(input, btn)
    {
        btn.addEventListener('click', e =>{
            e.preventDefault();
            this.post_json(input);
        });
    }

    // add(input)
    // {
    //     this.post_json(input);
    // }
    post_json(data)
    {
        const request = new XMLHttpRequest();
        let params = this.to_string(data);

        // console.log(this.url)
        // console.log(params)

        request.responseType =	'json';
        request.open('POST', this.url, true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        request.addEventListener('readystatechange', () => {
            if (request.readyState === 4 && request.status === 200) {
                let response = request.response;

                console.log(response);

                // this.test(response);

            }
        });
        request.send(params);
    }
    test(response)
    {
        console.log(response);
    }

    to_string(data)
    {
        let res = '';
        for(let i = 0; i < data.length; i++)
        {
            res += `data_${i}=${data[i].value}&`;
        }
        return res;
    }
}




if (document.querySelector('.addPersone'))
{
    const register = new Ajax('.addPersone', '../../modules/register/register.php');
    register.init();
}
if (document.querySelector('.inputPersone'))
{
    const login = new Ajax('.inputPersone', '../../modules/register/login.php');
    login.init();


}
if (document.querySelector('.personeCabBtn'))
{
    const personeCabBtn = new Ajax('.personeCabBtn', '../../../modules/auth/persone/personeCab.php');
    personeCabBtn.init();

}








