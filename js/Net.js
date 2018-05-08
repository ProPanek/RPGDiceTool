class Net { // eslint-disable-line no-unused-vars
	//Net methods


	static login(data, url) {
		$.ajax({
				type: "POST",
				url: url,
				data: {
					login: data.login,
					password: data.password
				},
				dataType: 'text',
				success: function (response) {

				},
				error: function (xhr) {
					if (xhr.status != 200) {
						swal(xhr.responseText)
						Promise.reject(Error(xhr.responseText))
					}
				}
			})
			.then(function (response) {
				swal({
						title: "status",
						text: response
					})
					.then(() => location.reload())
			})
	}

	static register(data, url) {
		$.ajax({
				type: "POST",
				url: url,
				data: {
					login: data.login,
					password: data.password,
					password_repeat: data.password_repeat,
					email: data.email
				},
				dataType: 'text',
				success: function (response) {
					swal(response)
				},
				error: function (xhr) {
					swal(xhr.responseText)
				}
			})
			.then(function (response) {
				swal({
						title: "status",
						text: response
					},
					function () {
						location.reload()
					});
			})
	}

	static ajax(data, url) {
		if (data.action === undefined) {
			return Promise.reject(Error("Wrong data construction"))
		}
		return $.ajax({
			type: "POST",
			url,
			data,
			dataType: 'text',
		})
	}
	static sendToAdmin(data, url) {
		var dice = JSON.stringify(data)
		var charName = $("#wybierz_postac").val()
		$.ajax({
			type: "POST",
			url: "php/set_database.php",
			data: {
				action: "set_save_dice",
				dice: dice,
				charName: charName
			},
			dataType: 'text',
			success: function (response) {},
			error: function (xhr) {
				alert("błąd" + xhr.responseText)
			}
		})
	}


}