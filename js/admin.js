$(document).ready(function () {
	var info = "pobieranie wyników: <input disabled style='width:70px;' type='text' value='wyłączone'>"

	const data = {
		action: "get_characters"
	}
	const response = Net.ajax(data, "php/get_database.php")

	const data2 = {
		action: "get_users"
	}
	const response2 = Net.ajax(data2, "php/get_database.php")

	const data3 = {
		action: "get_books"
	}
	const response3 = Net.ajax(data3, "php/get_database.php")

	Promise.all([response, response2, response3]).then(([characters, users, books]) => {
		const characters_list = JSON.parse(characters)
		for (var i = 0; i < characters_list.length; i++) {
			$("#gracze").append("<option id='gracze_pos' value='" + characters_list[i].nazwa + "'>" + characters_list[i].nazwa + "</option>")
		}
		var users_list = JSON.parse(users)
		for (var i = 0; i < users_list.length; i++) {
			$("#users").append("<option id='users_pos' value='" + users_list[i].login + "'>" + users_list[i].login + "</option>")
		}
		var book_list = JSON.parse(books)
		for (var i = 0; i < book_list.length; i++) {
			$("#book_select_delete").append("<option value='" + book_list[i].nazwa + "'>" + book_list[i].nazwa + "</option>")
		}
	})


	$("#info").html(info)
	$("#usun_wyniki").on("click", function () {
		return Net.ajax({ action: "delete_all_dice"}, "php/utilities_database.php")
	
	})
	$("#post_here").on("click", "#delete", function () {
		const data = {
			action: "delete_dice",
			bt_value: $("#delete").val()
		}
		return Net.ajax(data, "php/utilities_database.php")
		
	})
	$("#change_art").on("click", function () {
		const data = {
			action: "set_art",
			character: $("#gracze").val(),
			url: $("#art_target").val()
		}
		return Net.ajax(data, "php/set_database.php")
	
	})

	var interval_1
	function start() {

		interval_1 = setInterval(function () {
			return Net.ajax({ action: "get_dice"} , "php/get_database.php")
				.then((response) => {
					$('#post_here').empty()
					var obj_um = JSON.parse(response)
					for (var i = 0; i < obj_um.length; i++) {
						var div = $("<div class='hover' id='player_" + i + "' >" + obj_um[i].name + ": <br />" + obj_um[i].value + '<br /><button value="' + obj_um[i].name + '" id="delete">usuń</button></div>')
						$('#post_here').append(div)
					}
				})
		}, 3000)
	}

	function stop() {
		clearInterval(interval_1)
		$('#post_here').empty()
	}
	console.log($('select#users option').length)
	// if ($('#users').has('option').length == 0) {
	// 	$('#userDiv').html("wszystkie osoby mają dostęp")
	// }

	$("#start_load_dice").on('click', function () {
		start()
		info = "pobieranie wyników: <input disabled style='width:70px;' type='text' value='włączone'>"
		$("#info").html(info)
		$("#stop_load_dice").show()
		$("#start_load_dice").hide()

	})

	$("#stop_load_dice").on('click', function () {
		stop()
		$("#post_here").empty()
		var info = "pobieranie wyników: <input disabled style='width:70px;' type='text' value='wyłączone'>"
		$("#info").html(info)
		$("#stop_load_dice").hide()
		$("#start_load_dice").show()
	})
	$("#access_granted").on("click", function () {
		const data = {
			action: "set_user_access",
			user: $("#users").val()
		}
		return Net.ajax(data, "php/set_database.php")
			.then((response) => swal(response))
	})
	$("#add_book").on("click", function () {
		const data = {
			action: "set_book",
			name: $("#book_name").val(),
			url: $("#book_target").val(),
			category: $("#book_category").val()
		}
		return Net.ajax(data, "php/set_database.php")
			.then((response) => swal(response))
	})
	$("#delete_book").on("click", function () {
		const data = {
			action: "delete_book",
			name: $("#book_select_delete").val()
		}
		return Net.ajax(data, "php/set_database.php")
			.then((response) => swal(response))
	})
})