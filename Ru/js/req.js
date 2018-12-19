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
        body: JSON.stringify({ IdFridge: 0, IdUser: idUser})
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

            var stat = "Не пригоден";
            if(json[i].Status){
                stat = "Пригоден";
            }
            else{
                stat = "Не пригоден";
            }

            document.getElementById('medicaments_wrap').innerHTML +=
                '<div class="med_one" id="med_one">'+
                '<div id="row1">'+
                    '<div id="name"><b><u>Название</u>: &nbsp</b> '+ json[i].Name +'</div>'+
                    '<div id="amount"><b><u>Количество</u>: &nbsp</b> '+ json[i].Amount +'</div>'+
                    '<div id="price"><b><u>Цена</u>:</b> &nbsp &nbsp &nbsp &nbsp '+ (json[i].Price / 2.4).toFixed(2) +' &#8381</div>'+
                    '<div id="status"><b><u> Состояние</u>:</b> &nbsp &nbsp <span id="span'+ i +'">' + stat +'</span></div>'+
                    '<a id="edit" href="editMedicament.php?idFridge='+ json[i].IdFridge +'&idMedicament='+json[i].IdMedicament+'">Редактировать</a>'+
                '</div>'+
                '<div id="row2">'+
                    '<div id="dataProd"><b><u>Дата изготовления</u>:</b> &nbsp '+ dateProd.toISOString().slice(0,10) +'</div>'+
                    '<div id="dataExp"><b><u>Годен до</u>:</b> &nbsp '+ dateExpir.toISOString().slice(0,10) +'</div>'+
                    '<div id="temp"><b><u>Хранить</u>:</b> <b> &nbsp от </b> '+ json[i].MinTemperature +' C&deg<b> до </b>'+ json[i].MaxTemperature +' C&deg</div>'+
                    '<div></div>'+
                    '<a id="del" onClick="deleteMedicaments('+ json[i].IdMedicament +',\''+ json[i].Name.trim() +'\')" >Удалить</a>'+
                '</div>'+
                '</div>';
            if(!json[i].Status){
                document.querySelector('#span'+i).style = "color: red;";
            }
        }
    }else{
        document.getElementById('messageError').style = 'display:inherit;'; 
    }
}

function saveMedicaments(){
    if(medicamentValid()){
      saveMedicament(idMedicament, idFridge, nameMedicament.value, amount.value, dataProduction.value,
                    expirationDate.value, price.value, minTemperature.value, maxTemperature.value, document.getElementById("status").value);
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

function addMedicaments(){
    if(medicamentValid()){
      addMedicament(idFridge, nameMedicament.value, amount.value, dataProduction.value,
                    expirationDate.value, price.value, minTemperature.value, maxTemperature.value, document.getElementById("status").value);
    }
}

function addMedicament(idFridge, nameMedicament, amount, dataProduction,
    expirationDate, price, minTemperature, maxTemperature, status){
        fetch('https://medicalfridgeserver.azurewebsites.net/api/Medicaments', {
            method: 'post',
            headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({  IdMedicament: 0, IdFridge: idFridge,
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

function medicamentValid(){
    if(new Date(dataProduction.value) > new Date(expirationDate.value)){
        alert("Дата изготовления не может быть больше даты пригодности!");
        return false;
    }

    if((document.getElementById('nameMedicament').value.trim() == "") && (!document.getElementById('amount').validity.valid || (amount.value == "")) &&
        (!document.getElementById('price').validity.valid || (price.value == "")) && (!document.getElementById('dataProduction').validity.valid || (dataProduction.value == "")) &&
        (!document.getElementById('expirationDate').validity.valid || (expirationDate.value == "")) && (!document.getElementById('minTemperature').validity.valid || (minTemperature.value == "")) &&
        (!document.getElementById('maxTemperature').validity.valid || (maxTemperature.value == ""))){
        
        return true;
    }


    if(document.getElementById('nameMedicament').value.trim() == ""){
        document.getElementById('nameMedicament').style = "border-style: solid; border-width: 2px; border-color: red;";
        return false;
    }
    else
        document.getElementById('nameMedicament').style = "border-style: none;";

    if(!document.getElementById('amount').validity.valid || (amount.value == "")){
        document.getElementById('amount').style = "border-style: solid; border-width: 2px; border-color: red;";
        return false;
    }
    else
        document.getElementById('amount').style = "border-style: none;";

    if(!document.getElementById('price').validity.valid || (price.value == "")){
        document.getElementById('price').style = "border-style: solid; border-width: 2px; border-color: red;";
        
        let pric = parseFloat(price.value).toFixed(2);
        if(!isNaN(pric))
            price.value = pric;
            
        if(document.getElementById('price').validity.valid)
            document.getElementById('price').style = "border-style: none;";

        return false;
    }
    else
        document.getElementById('price').style = "border-style: none;";

    if(!document.getElementById('dataProduction').validity.valid || (dataProduction.value == "")){
        document.getElementById('dataProduction').style = "border-style: solid; border-width: 1px; border-color: red;";
        return false;
    }
    else
        document.getElementById('dataProduction').style = "border-style: none;";

    if(!document.getElementById('expirationDate').validity.valid || (expirationDate.value == "")){
        document.getElementById('expirationDate').style = "border-style: solid; border-width: 1px; border-color: red;";
        return false;
    }
    else
        document.getElementById('expirationDate').style = "border-style: none;";

    if(!document.getElementById('minTemperature').validity.valid || (minTemperature.value == "")){
        document.getElementById('minTemperature').style = "border-style: solid; border-width: 2px; border-color: red;";

        let min = parseFloat(minTemperature.value).toFixed(2);
        if(!isNaN(min))
            minTemperature.value = min;
            
        if(document.getElementById('minTemperature').validity.valid)
            document.getElementById('minTemperature').style = "border-style: none;";

        return false;
    }
    else
        document.getElementById('minTemperature').style = "border-style: none;";

    if(!document.getElementById('maxTemperature').validity.valid || (maxTemperature.value == "")){
        document.getElementById('maxTemperature').style = "border-style: solid; border-width: 2px; border-color: red;";

        let max = parseFloat(maxTemperature.value).toFixed(2);
        if(!isNaN(max))
            maxTemperature.value = max;
            
        if(document.getElementById('maxTemperature').validity.valid){
            document.getElementById('maxTemperature').style = "border-style: none;";
            return true;
        }

        return false;
    }
    else
        document.getElementById('maxTemperature').style = "border-style: none;";

    return true;
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
    if(confirm("Вы уверены, что хотите удалить медикамент <" + name +">?")){
        fetch('https://medicalfridgeserver.azurewebsites.net/api/Medicaments/' + id , {
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

