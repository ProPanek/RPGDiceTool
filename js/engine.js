$(document).ready(function () { 
	const userCharacters = {
		action: "get_user_characters",
		login: $("#login").val()
	}
	Net.ajax(userCharacters, "php/get_database.php")
		.then((result) => {
			const json = JSON.parse(result)
			for (var i = 0; i < json.length; i++) {
				$("#wybierz_postac").append(json[i])
			}
	}).then(() => {
		loadData()
	})
	loadFromLocalStorage()
	loadUiControllers(wczytaj)
	//funkcja która ładuje się jako pierwsza, chowa wszystkie niepotrzebne divy i kontroluje ich wyświetlanie.
	// przykładowe wykorzystanie:
	
	function loadData() {
		

		const data = {
			action: "get_avatar",
			login: $("#login").val(),
			character: $("#wybierz_postac").val()
		}
		const response = Net.ajax(data, "php/get_database.php")
		
		const data2 = {
			action: "get_onload",
			character: $("#wybierz_postac").val()
		}
		const response2 = Net.ajax(data2, "php/get_database.php")

		const data3 = {
			action: "get_notes",
			character: $("#wybierz_postac").val()
		}
		const response3 = Net.ajax(data3, "php/get_database.php")

		const response4 = Promise.resolve(wczytaj)

		const data5 = {
			action: "get_books"
		}
		const response5 = Net.ajax(data5, "php/get_database.php")

		return Promise.all([response, response2, response3, response5, response4]).then(([avatar_url, background_url, notes, books]) => {
			var result = JSON.parse(avatar_url)
			console.log(result)
			var html = $("<img>", {src: result.avatar})
			$("#avatar_postaci").html(html)

			$(document.body).css({
				'background': "url(" + background_url + ") no-repeat center center"
			})

			$("#notatnik_pre").html(notes)

			var response = JSON.parse(books)
			for (var i = 0; i < response.length; i++) {
				var nazwa = response[i].nazwa.escapeDiacritics()
				nazwa = nazwa.replace(/\s/g, '');
				$(".sidenav").append("<button id='" + nazwa + "' class='" + response[i].kategoria + "'>" + response[i].nazwa + "</button>")
				$('.sidenav').on('click', "#" + nazwa, {
					link: response[i].link
				}, function (event) {
					$("#closeiframe").show()
					$(".iframebook").prop("src", event.data.link)
					$(".iframebook").css("display", "block")
					$(".iframebook").css("width", "100%")
				});
			}
			$(".lorebook").hide()
		})
	}
	//wczytytwanie postaci gracza z bazy danych
	function wczytaj() {
		const data = {
			action: "get_character_statistics",
			character: $("#wybierz_postac").val(),
			login: $("#login").val()
		}
		Net.ajax(data, "php/get_database.php")
			.then(load_values)
			.then(() => swal($("#login").val() + " wczytałem twoją postać o nazwie: " + $("#wybierz_postac").val() + "", "", "success"))
			.then(toLocalStorage)
			
		function load_values(response) {
			const input_classes = ['.stat input', '.walka input', '.magia input', '.zbroja input']
			const staty = JSON.parse(response)
			const array = [JSON.parse(staty.generalStats), JSON.parse(staty.fightStats), JSON.parse(staty.magicStats), JSON.parse(staty.armorStats)]
			for (var j = 0; j < array.length; j++) {
				var inputs_staty = $(input_classes[j]);
				for (var i = 0; i < array[j].length; i++) {
					$(inputs_staty[i]).val(array[j][i])
				}
			}
		}
	}

	$(".stat, .walka, .magia, #login, .zbroja, #mod_z, #mod_r, #mod_w").focusout(function () {
		toLocalStorage()
	})
	
	function loadFromLocalStorage() {
		const mody = JSON.parse(localStorage.getItem("mods") || "{}")

		$("#mod_z").val(mody[0])
		$("#mod_r").val(mody[1])
		$("#mod_w").val(mody[2])
		$("#mod_d").val(mody[3])

		const general_stats = JSON.parse(localStorage.getItem("staty") || "[]")
		const inputs_stats = $(".stat input");
		for (var i = 0; i < inputs_stats.length; i++) {
			$(inputs_stats[i]).val(general_stats[i])
		}

		const fight_stats = JSON.parse(localStorage.getItem("staty_walka") || "[]")
		const inputs_fight = $(".walka input");
		for (var i = 0; i < inputs_fight.length; i++) {
			$(inputs_fight[i]).val(fight_stats[i])
		}

		const magic_stats = JSON.parse(localStorage.getItem("staty_magia") || "[]")
		const inputs_magic = $(".magia input");
		for (var i = 0; i < inputs_magic.length; i++) {
			$(inputs_magic[i]).val(magic_stats[i])
		}
		const staty_zbroja = JSON.parse(localStorage.getItem("staty_zbroja") || "[]")
		const inputs_zbroja = $(".zbroja input");
		for (var i = 0; i < inputs_zbroja.length; i++) {
			$(inputs_zbroja[i]).val(staty_zbroja[i])
		}
		var login = localStorage.getItem("login") || "{}"
		var js_login = JSON.parse(login)
		$("#login").val(js_login[0])
	}

	$("#zaloguj_btn").on("click", function () {
		const data = {
			login: $("#login").val(),
			password: $("#password").val()
		}
		Net.login(data, "php/psswd.php")

	})

	$("#zarejestruj_btn").on("click", function () {
		const data = {
			login: $("#login_register").val(),
			password: $("#password_register").val(),
			password_repeat: $("#password_r_register").val(),
			email: $("#email_register").val()
		}
		Net.register(data, "php/register.php")
	})

	

})
