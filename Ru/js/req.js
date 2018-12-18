function checkUser(login, password){
    if(!document.getElementById('login').validity.valid){
        document.getElementById('login').style = "border-style: solid; border-width: 2px; border-color: red;";
    }
    else if(!(document.getElementById('password').validity.valid)){
        document.getElementById('login').style = "border-style: none;";
        document.getElementById('password').style = "border-style: solid; border-width: 2px; border-color: red;";
    }
    else{
        document.getElementById('password').style = "border-style: none;";
        fetch('https://medicalfridgeserver.azurewebsites.net/api/Users/' + login + '/' + password, {
        method: 'get'
        })
        .then(response => response.json())
        .then(handleCheckUser) 
        .catch(console.error);
    }
};

function handleCheckUser(json){
    if (json != "") {
        var date = new Date(new Date().getTime() + 60 * 60 * 24 * 6000 );
        document.cookie = "Id="+json[0].IdUser+"; path=/; expires=" + date.toUTCString();
        document.cookie = "Login="+json[0].Login+"; path=/; expires=" + date.toUTCString();
        document.cookie = "Password="+json[0].Password+"; path=/; expires=" + date.toUTCString();
        document.cookie = "Role="+json[0].Role+"; path=/; expires=" + date.toUTCString();
        document.location.reload();
      }
      else{ 
          alert("Логин или пароль были введены не верно!");
      }
}

function logout(){
    var date = new Date(new Date().getTime() - 1000);
    document.cookie = "Id=; path=/; expires=" + date.toUTCString();
    document.cookie = "Login=; path=/; expires=" + date.toUTCString();
    document.cookie = "Password=; path=/; expires=" + date.toUTCString();
    document.cookie = "Role=; path=/; expires=" + date.toUTCString();
}

function loadUser(id){
    fetch('https://medicalfridgeserver.azurewebsites.net/api/Users/'+id , {
    method: 'get'
    })
    .then(response => response.json())
    .then(handleLoadUser) 
    .catch(console.error);
}
   
function handleLoadUser(json) {
    if (json[0].Login != "") {  
        document.getElementById('country').value = json[i].Country;
        document.getElementById('city').value = json[i].City;
        document.getElementById('address').value = json[i].Address;
        document.getElementById('phone').value = json[i].Phone;
        document.getElementById('nameOrganiz').value = json[i].NameOrganization;
        document.getElementById('login').value = json[i].Login;
    }
}

function saveUser(id, login, pass, nameOrg, role, country, city, address, phone){
    fetch('https://medicalfridgeserver.azurewebsites.net/api/Users/' + id, {
        method: 'put',
        headers: {
        'Accept': 'application/json, text/plain, */*',
        'Content-Type': 'application/json'
        },
        body: JSON.stringify({  IdUser: id, Login: login,
                                Password: pass, NameOrganization: nameOrg, Role: role,
                                Country: country, City: city, Address: address, Phone: phone})
    }).then(res=>res.json())
    .then(function(json){
        if(json){
            var date = new Date(new Date().getTime() + 60 * 60 * 24 * 6000 );
            document.cookie = "Login="+login+"; path=/; expires=" + date.toUTCString();
            document.cookie = "Password="+pass+"; path=/; expires=" + date.toUTCString();
            document.location.reload();
        }
        else{
            alert("Пользователь с таким логином уже зарегистрирован!");
        }
    });
}

function loadFridge(id){
    fetch('https://medicalfridgeserver.azurewebsites.net/api/Fridges/' + id , {
    method: 'get'
    })
    .then(response => response.json())
    .then(handleLoadFridge) 
    .catch(console.error);
}

function handleLoadFridge(json) {
    if(json != ""){
        for (let i = 0; i < json.length; i++) {
            document.getElementById('fridge_wrap').innerHTML += 
                '<div class="fridge" id="' + json[i].IdFridge + '">'+
                    '<p id="box1"><b><u> Камера № ' + json[i].IdFridge + ' </u></b></p>'+
                    '<p id="box22"><b>Влажность: ' + json[i].LastHumidity + ' </b>%</p>'+
                    '<p id="box2"><b>Температура: ' + json[i].LastTemperature + ' C&deg</b></p>'+
                    '<p id="box3"><a href="medicaments.php?idFridge='+ json[i].IdFridge +'"><b>Содержимое</b></a></p>'+              
                    '<form><p id="box4"><a onClick="deleteFridge('+json[i].IdFridge+')"><b>Удалить камеру</b></a></p></form>'+
                '</div>';
        }
    }
    else{
        document.getElementById('messageError').style = 'display:inherit;'; 
    }
}

function addFridge(idUser){
    fetch('https://medicalfridgeserver.azurewebsites.net/api/Fridges', {
        method: 'post',
        headers: {
        'Accept': 'application/json, text/plain, */*',
        'Content-Type': 'application/json'
        },
        body: JSON.stringify({ IdFridge: 1110, IdUser: idUser})
    }).then(res=>res.json())
    .then(function(json){
        if(json){
            document.location.reload();
        }
        else{
            alert("Что-то пошло не так!");
        }
    });
}

function deleteFridge(id){
    if(confirm("Вы уверены, что хотите удалить камеру №" + id +" ?")){
        fetch('https://medicalfridgeserver.azurewebsites.net/api/Fridges/' + id , {
            method: 'delete'
        })
        .then(response => response.json())
        .then(function(json){ 
            if(json){
                document.location.reload();
            }
            else{
                alert("Что-то пошло не так!");
            }
        }) 
        .catch(console.error);
    }
}

function loadMedicaments(id){
    fetch('https://medicalfridgeserver.azurewebsites.net/api/Medicaments/' + id , {
        method: 'get'
    })
    .then(response => response.json())
    .then(handleLoadMedicaments) 
    .catch(console.error);
}

function handleLoadMedicaments(json){
    if(json != ""){

        for (let i = 0; i < json.length; i++) {
            var dateProd = new Date(json[i].DataProduction);
            dateProd.setDate(dateProd.getDate() + 1);
            var dateExpir =new Date(json[i].ExpirationDate);
            dateExpir.setDate(dateExpir.getDate() + 1);
            
            document.getElementById('medicaments_wrap').innerHTML += 
                '<br><span><b><u>Название препарата:</u></b> '+ json[i].Name +'; <b><u>Количество:</u></b> '+ json[i].Amount +'; <b><u>Цена:</u></b> '+ json[i].Price +
                '; <b><u>Дата изготовления:</u></b> '+ dateProd.toISOString().slice(0,10) +'; <b><u>Годен до:</u></b> '+ dateExpir.toISOString().slice(0,10) +'; <b><u>Хранить</u></b> <b>от</b> '+ json[i].MinTemperature +' C&deg'+
                '<b>до</b> '+ json[i].MaxTemperature +' C&deg'+ '; <b><u> Статус:</u></b> ' + json[i].Status +
                '<button"><a href="editMedicament.php?idMedicament='+ json[i].IdMedicament +'&idFridge='+json[i].IdFridge+'">Редактировать</a></button>'+
                '<button onClick="deleteMedicaments('+ json[i].IdMedicament +',\''+ json[i].Name.trim() +'\')" >Удалить</button></span>';
        }
    }else{
        document.getElementById('messageError').style = 'display:inherit;'; 
    }
}

function saveMedicament(id, idFridge, nameMedicament, amount, dataProduction,
    expirationDate, price, minTemperature, maxTemperature, status){
        fetch('https://medicalfridgeserver.azurewebsites.net/api/Medicaments/' + id, {
            method: 'put',
            headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({  IdMedicament: id, IdFridge: idFridge,
                                    Name: nameMedicament, Amount: amount, DataProduction: dataProduction,
                                    ExpirationDate: expirationDate, Price: price, MinTemperature: minTemperature,
                                    MaxTemperature: maxTemperature, Status: status
                                })
        }).then(res=>res.json())
        .then(function(json){
            if(json){
                document.location.href = ("medicaments.php?idFridge="+idFridge);
            }
            else{
                alert("Что-то пошло не так!");
            }
        });
}

function loadOneMedicaments(value){
    fetch('https://medicalfridgeserver.azurewebsites.net/api/Medicaments/?value=' + value , {
        method: 'get'
    })
    .then(response => response.json())
    .then(handleLoadOneMedicaments) 
    .catch(console.error);
}

function handleLoadOneMedicaments(json){
    if(json != ""){
        document.getElementById('nameMedicament').value = json[i].Name;
        document.getElementById('amount').value = json[i].Amount;
        document.getElementById('price').value = json[i].Price;
        var dateProd = new Date(json[i].DataProduction);
        dateProd.setDate(dateProd.getDate() + 1);
        document.getElementById('dataProduction').value = dateProd.toISOString().slice(0,10);
        var dateExpir =new Date(json[i].ExpirationDate);
        dateExpir.setDate(dateExpir.getDate() + 1);
        document.getElementById('expirationDate').value = dateExpir.toISOString().slice(0,10);
        document.getElementById('minTemperature').value = json[i].MinTemperature;
        document.getElementById('maxTemperature').value = json[i].MaxTemperature;
        document.getElementById("status").value = json[i].Status;
    }
}

function deleteMedicaments(id, name){
    if(confirm("Вы уверены, что хотите удалить препарат <" + name +">?")){
        fetch('https://medicalfridgeserver.azurewebsites.net/api/Medicaments/' + id , {
            method: 'delete'
        })
        .then(response => response.json())
        .then(function(json){ 
            if(json){
                alert("Препарат <"+ name +"> был удалён"); 
                document.location.reload();
            }
            else{
                alert("Что-то пошло не так!");
            }
        }) 
        .catch(console.error);
    }
}

