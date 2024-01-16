fetch('https://randomuser.me/api/')
    .then(data => data.json())
    .then(datas => {
        console.log(datas.results[0].gender);
        const loading = document.getElementById('loading');
        const name = document.getElementById('gender');
        const email = document.getElementById('email');
        const birthday = document.getElementById('phone');

        loading.innerHTML = '';
        name.innerHTML = 'Gender : ' +datas.results[0].gender;
        email.innerHTML = 'Email : ' + datas.results[0].email;
        birthday.innerHTML = 'Phone : ' + datas.results[0].phone;
    });


// $.ajax({
//     method: 'GET',
//     url: 'https://api.api-ninjas.com/v1/randomuser',
//     headers: { 'X-Api-Key': 'JL8uHnrZfVr76Rcn87Bohw==Tyq7hEX514VVggG3'},
//     contentType: 'application/json',
//     success: function(result) {
//         console.log(result.birthday);
//         const  loading = document.getElementById('loading');
//         const  name = document.getElementById('name');
//         const  email = document.getElementById('email');
//         const  birthday = document.getElementById('birthday');

//         loading.innerHTML = '';
//         name.innerHTML = 'Name : ' +result.name;
//         email.innerHTML = 'Email : '+result.email;
//         birthday.innerHTML = 'Birthday : '+result.birthday;
//     },
//     error: function ajaxError(jqXHR) {
//         console.error('Error: ', jqXHR.responseText);
//     }
// });