/*
Главный js
*/

/**
* Функция позволяет получать данные из форм
*/
function getData(obj_form)
{
    var hData = {};
    $('input, textarea', obj_form).each(function() {
        if (this.name && this.name != '') {
            hData[this.name] = this.value;
        }
    });

    return hData;
}


/**
* Посылает AJAX запрос в RegisterController для регистрации пользователя
*/
function register()
{
	formData = getData('#registerData');

	$.ajax({
		type: 'POST',
		data: formData,
		dataType: 'json',
		url: '/register/register',
		async: true,
		success: function(data) {
			if (!data['success']) {
				$('#registerErrors').show();
				$('#errorText').html(data['message']);
			} else {
				location.href = '/user';
			}
		}
	});
}


/**
* Посылает AJAX запрос в AuthController для авторизации пользователя
*/
function login()
{
	formData = getData('#authData');

	$.ajax({
		type: 'POST',
		data: formData,
		dataType: 'json',
		url: '/auth/auth',
		async: true,
		success: function(data) {
			if (!data['success']) {
				$('#authErrors').show();
				$('#errorText').html(data['message']);
			} else {
				location.href = '/user';
			}
		}
	});
}

/**
* Посылает AJAX-запрос на выход из аккаунта
*/
function logout()
{
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: '/user/logout',
		async: true,
		success: function(data) {
			location.href = '/';
		}
	});	
}

/**
* Скрывает сообщение с id = blockId
*/
function closeMessage(blockId)
{
	$(blockId).hide();
}


/**
* Устанавливает указанный язык
*/
function setLang(nowLang)
{
	let lang = '';
	if (nowLang == 'ru') {
		lang = 'en';
	} else {
		lang = 'ru';
	}

	data = {lang: lang};

	$.ajax({
		type: 'POST',
		data: data,
		dataType: 'json',
		url: '/index/setlang',
		async: true,
		success: function(data) {
			location.reload();
		}
	});	
}