function loadUiControllers(wczytaj){
    // login/register button
    //switching categories
    $("#staty").hide();
    $("#flex_umiejetnosci").hide();
    $("#lista_walki").hide();
    $("#lista_walki_1").hide();
    $("#lista_magii").hide();
    $("#zbroja").hide();
    $("#btn_umiejetnosci").on("click", function () {
        $("#lista_walki_1").hide();
        $("#flex_umiejetnosci").show();
        $("#lista_walki").hide();
        $("#lista_magii").hide();
        $("#staty").show();
        $("#zbroja").hide();
    })
    $("#btn_walka").on("click", function () {
        $("#lista_walki_1").show()
        $("#flex_umiejetnosci").hide()
        $("#lista_walki").show()
        $("#lista_magii").show()
        $("#staty").hide()
        $("#zbroja").hide()
    })
    $("#btn_zbroja").on("click", function () {
        $("#lista_walki_1").hide()
        $("#zbroja").show()
        $("#flex_umiejetnosci").hide()
        $("#lista_walki").hide()
        $("#lista_magii").hide()
        $("#staty").hide()
    })

    //booksButton
    $("#sidenavbt").on("click", function () {
        $(".sidenav").css("width", "15%")
    })
    $("#sidenavbtclose").on("click", function () {
        $(".sidenav").css("width", "0")
    })
    $("#closeiframe").on("click", function () {
        // $(".sidenav").css("width", "0")
        $(".iframebook").css("width", "0")
        $(".iframebook").css("display", "none")
        $("#closeiframe").hide()
    })

    $("#wyślij_staty").on("click", function () {
        toLocalStorage()
        swal({
            title: "Jesteś pewien?",
            text: "Statystyki twojej postaci zostaną wysłane do bazy danych",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "green",
            confirmButtonText: "Tak, wyślij",
            cancelButtonText: "Anuluj",
            showLoaderOnConfirm: true
        }).then(() => {
            const data = {
                action: "set_save_character",
                general_stats: JSON.stringify(localStorage.getItem("staty")) || "[]",
                fight_stats: JSON.stringify(localStorage.getItem("staty_walka")) || "[]",
                magic_stats: JSON.stringify(localStorage.getItem("staty_magia")) || "[]",
                armor_stats: JSON.stringify(localStorage.getItem("staty_zbroja")) || "[]",
                character: $("#wybierz_postac").val(),
                login: $("#login").val()
            }
            return Net.ajax(data, "php/set_database.php")
                .then(() => swal("", "zapisałem twoją postać o nazwie: " + $("#wybierz_postac").val() + "", "success"))
        })
    })

    $("#wybierz_postac").on("change", function () {
        swal({
            title: "Wczytać postać?",
            text: "",
            type: "info",
            confirmButtonColor: "green",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Tak, wczytaj",
            cancelButtonText: "Anuluj",
        }).then(wczytaj)
            .then(loadData)
        // ShowNotes()
    })

    $("#wczytaj_staty").on("click",{ wczytaj: wczytaj} , function() {
        swal({
            title: "Wczytać postać?",
            text: "",
            type: "info",
            confirmButtonColor: "green",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Tak, wczytaj",
            cancelButtonText: "Anuluj",
        }).then((result) => {
            if (result.value) {
                wczytaj()
            }
            else if (result.dismiss === swal.DismissReason.cancel) {
                // nothing
            }
        })
        // .then(wczytaj)
    })

    $("#nowa_postac").on("click", function () {
        var login = $("#login").val()
        swal({
            title: "Nazwa postaci",
            //text: "Write something interesting:",
            input: "text",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top"
        }).then((result) => {
            const data = {
                action: "set_new_character",
                character: result.value,
                login: login
            }
            if (result.value === false) return false;
            if (result.value === "") {
                swal.showInputError("Nie zostawiaj tego pola pustego!");
                return false
            }
            return Net.ajax(data, "php/set_database.php")
                .then(() => swal("postać " + result.value + " została dodana", "", "success"))
                .then(() => {
                    setTimeout(function () {
                        location.reload()
                    }, 2000)
                })
        });
    })

    $("#usun_postac").on("click", function () {
        var login = $("#login").val()
        var character = $("#wybierz_postac").val()
        console.log("test")
        swal({
            title: "Jesteś pewien?",
            text: "Statystyki twojej postaci jak i sama postać zostanie nieodwracalnie usunięta",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "green",
            confirmButtonText: "Tak, wyślij",
            cancelButtonText: "Anuluj",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(() => {
            const data = {
                action: "delete_character",
                login: login,
                character: character
            }
            return Net.ajax(data, "php/utilities_database.php")
                .then(() => swal("", "usunąłem twoją postać" + $("#wybierz_postac").val() + "", "success"))
                .then(() => {
                    setTimeout(function () {
                        location.reload()
                    }, 2000)
                })

        })
    })

    $(".stat").on("click", "button", function (e) {
        const stat = $(e.target).closest(".stat") //pobieranie elementu inputa najbizszego kliknietego buttona

        const sila = $("#sila").val()
        const zrecznosc = $("#zrecznosc").val()
        const inteligencja = $("#inteligencja").val()
        const wytrzymalosc = $("#wytrzymalosc").val()
        const wola = $("#wola").val()
        const zmysly = $("#zmysly").val()
        

        var attribValue = 0
        if (stat.attr('class').split(" ")[1] == 'sil') {
            attribValue = Dice.attrib_bonus(sila)
        }
        if (stat.attr('class').split(" ")[1] == 'zr') {
            attribValue = Dice.attrib_bonus(zrecznosc)
        }
        if (stat.attr('class').split(" ")[1] == 'int') {
            attribValue = Dice.attrib_bonus(inteligencja)
        }
        if (stat.attr('class').split(" ")[1] == 'wyt') {
            attribValue = Dice.attrib_bonus(wytrzymalosc)
        }
        if (stat.attr('class').split(" ")[1] == 'zmy') {
            attribValue = Dice.attrib_bonus(zmysly)
        }
        if (stat.attr('class').split(" ")[1] == 'wol') {
            attribValue = Dice.attrib_bonus(wola)
        }
        // if (stat.attr('class').split(" ")[1] == 'int_wol') {
        //     const int_wol = Math.ceil((parseInt(inteligencja) + parseInt(wola)) / 2)
        //     attribValue = Dice.attrib_bonus(int_wol)
        // }
        var bonus = parseInt(stat.children().eq(2).val()) || 0
        attribValue = parseInt(attribValue)
        bonus = parseInt(bonus)

        // var attrib = $(e.target).closest(".stat") //pobieranie elementu inputa najbizszego kliknietego buttona
        var value = stat.find("input").val() // pobieranie wartosci z inputa
        var mod_sukc = parseInt($("#mod_r").val()) || 0
        // if (stat.attr('class').split(" ")[1] == 'def') {
        //     mod_sukc = 0;
        // }
        var forDiceValue = parseInt(value) + mod_sukc + attribValue + bonus
        console.log(forDiceValue, mod_sukc, value)
        //console.log("STATY | wartość: " + value + " | mod_sukc: " + mod_sukc + " | bonus: " + bonus )
        const result = Dice.k100(forDiceValue)
        const s = result[0]
        const tab_suc = result[1]
        const wyswietl = "<div> Sukcesy:  " + s.s + " <br> Krytyczne sukcesy: " + s.sk + " <br>Krytyczne porażki : " + s.fk + "<br>|" + tab_suc.join("|") + "| </div>"
        $("#wynik_kosci").css("flex", "6");
        $("#wynik_kosci_k20").css("flex", "0");
        $("#wynik_kosci_k20").html("");
        $("#wynik_kosci").html(wyswietl)
        Net.sendToAdmin(wyswietl)
    })
    //losowanie wyników z tabelki magii
    $(".magia").on("click", "button", function (e) {
        const stat = $(e.target).closest(".magia")
        const bonus_suc = parseInt(stat.children().eq(2).val()) || 0
        const bonus_wal = parseInt(stat.children().eq(3).val()) || 0

        const inteligencja = $("#inteligencja").val()

        var wartosc = 0;
        if (stat.attr('class').split(" ")[1] == 'int') {
            wartosc = Dice.attrib_bonus(inteligencja)
        }
        var value = stat.find("input").val()
        const mod_sukc = parseInt($("#mod_r").val()) || 0
        //console.log("przed - wartoś umiejętności: " + value," modyfikator walki: "+mod_sukc, "bonus od atrybutu:"+wartosc);
        value = parseInt(value) + mod_sukc + wartosc
        //console.log("wartoś po sumowaniu: "+value);
        if ($("#walka_kon").is(':checked')) {
            var val_k100 = value - 10 + bonus_suc;
            var val_k20 = (bonus_wal + value + parseInt($("#jezdziectwo").val())) / 2;
            value = undefined
        }
        const result = Dice.k100((value + bonus_suc) || val_k100)
        const s = result[0]
        const tab_suc = result[1]
        const arr = Dice.k20((value + bonus_wal) || val_k20)
        const wyswietl_wal = "Wynik rzutu: " + Math.round(arr[0]) + "<br> |" + arr[1] + "|" + arr[2] + "|"
        var wyswietl = "Sukcesy:  " + s.s + " <br> Krytyczne sukcesy: " + s.sk + " <br>Krytyczne porażki : " + s.fk + "<br>|" + tab_suc.join("|") + "|"
        $("#wynik_kosci").css("flex", "3");
        $("#wynik_kosci_k20").css("flex", "3");

        $("#wynik_kosci").html(wyswietl)
        $("#wynik_kosci_k20").html(wyswietl_wal)

        wyswietl = "<div>" + wyswietl + wyswietl_wal + "</div>"
        Net.sendToAdmin(wyswietl)
    })
    //losowanie wyników z tabelki walki
    $(".walka").on("click", "button", function (e) {
        var stat = $(e.target).closest(".walka")

        var bonus_suc = parseInt(stat.children().eq(2).val()) || 0
        var bonus_wal = parseInt(stat.children().eq(3).val()) || 0
        var wartosc = 0;
        if (stat.attr('class').split(" ")[1] == 'sil') {
            wartosc = Dice.attrib_bonus($("#sila").val())
        }
        if (stat.attr('class').split(" ")[1] == 'zr') {
            wartosc = Dice.attrib_bonus($("#zrecznosc").val())
        }
        console.log(wartosc)
        if ($("#walka_dwie_bronie").is(':checked')) {
            if (stat.attr('class').split(" ")[3] == 'dwie') {
                wartosc = Dice.attrib_bonus($("#sila").val())
            }
        } else {
            if (stat.attr('class').split(" ")[3] == 'dwie') {
                wartosc = Dice.attrib_bonus($("#zrecznosc").val())
            }
        }
        var value = parseInt(stat.find("input").val())
        if (stat.attr('class').split(" ")[2] == 'at') {
            var mod_sukc = parseInt($("#mod_r").val()) || 0
            var mod_walki = parseInt($("#mod_w").val()) || 0
            value = parseInt(value + mod_walki + wartosc + mod_sukc)
        }
        if (stat.attr('class').split(" ")[2] == 'def') {
            var mod_sukc = parseInt($("#mod_r").val()) || 0
            var mod_obrona = parseInt($("#mod_d").val()) || 0
            value = parseInt(value + mod_obrona + wartosc + mod_sukc)
        }

        if (stat.find("input").attr('id') == "Refleks") {
            var mod_obrona = parseInt($("#mod_d").val()) || 0
            value = value + (value * ($("#refleks_z").val() / 100)) + mod_obrona
        }
        if ($("#walka_kon").is(':checked')) {
            var val_k100 = value - 10 + bonus_suc;
            var val_k20 = (bonus_wal + value + parseInt($("#jezdziectwo").val())) / 2;
            value = undefined
        }

        var arr = Dice.k20((value + bonus_wal) || val_k20)
        var wyswietl_wal = "Wynik rzutu: " + Math.round(arr[0]) + "<br> |" + arr[1] + "|" + arr[2] + "|"
        // if(stat.find("input").attr('id') == "Refleks" || stat.find("input").attr('id') == "b_miotana_h1" || stat.find("input").attr('id') == "luki_h2" || stat.find("input").attr('id') == "kusze_h1" || stat.find("input").attr('id') == "kusze_h2" ){
        var result = Dice.k100((value + bonus_suc) || val_k20)
        var s = result[0]
        var tab_suc = result[1]
        var wyswietl = "Sukcesy:  " + s.s + " <br> Krytyczne sukcesy: " + s.sk + " <br>Krytyczne porażki : " + s.fk + "<br>|" + tab_suc.join("|") + "|"

        var wyswietl_adm = wyswietl + "<hr>" + wyswietl_wal
        // }
        Net.sendToAdmin(wyswietl_adm)
        $("#wynik_kosci").css("flex", "3");
        $("#wynik_kosci_k20").css("flex", "3");
        $("#wynik_kosci").html(wyswietl)
        $("#wynik_kosci_k20").html(wyswietl_wal)
    })
    //losowanie wyników z tabelki zbroi
    $(".zbroja").on("click", "button", function (e) {
        const stat = $(e.target).closest(".zbroja")
        const bonus = parseInt(stat.children().eq(2).val())
        var value = parseInt(stat.find("input").val())
        value = value + bonus
        const przebicie = -Math.abs($("#mod_z").val())
        if (stat.find("input").attr('id') == "ciecia" || stat.find("input").attr('id') == "obuch" || stat.find("input").attr('id') == "pociski" ||
            stat.find("input").attr('id') == "lodiwoda_z" || stat.find("input").attr('id') == "ogien_z" || stat.find("input").attr('id') == "blyskawice_z") {
            value = value + value * (przebicie / 100)
        }
        const arr = Dice.k20(value)
        var wyswietl_wal = "Wynik rzutu: " + Math.round(arr[0]) + "<br> |" + arr[1] + "|" + arr[2] + "|"

        $("#wynik_kosci").css("flex", "0");
        $("#wynik_kosci_k20").css("flex", "6");
        $("#wynik_kosci").html("");
        $("#wynik_kosci_k20").html(wyswietl_wal)
        wyswietl_wal = "<div>" + wyswietl_wal + "</div>"
        Net.sendToAdmin(wyswietl_wal)
    })
    // rzut customową kością
    $("#custom").on("click", function () {
        var n = $("#dice_counter").val()
        var d = $("#dot_counter").val()
        var tab_dice = []
        for (var i = 0; i < n; i++) {
            tab_dice.push(Math.floor(Math.random() * d) + 1)
        }
        var wyswietl = "Wynik twoich rzutów to: <br>| " + tab_dice.join(" | ") + " |" + ""
        $("#wynik_kosci").css("flex", "6");
        $("#wynik_kosci_k20").css("flex", "0");
        $("#wynik_kosci").html(wyswietl)
        wyswietl = "<div>" + wyswietl + "</div>"
        Net.sendToAdmin(wyswietl)
    })

    $("#1k100").on("click", function () {
        var tab_dice = []
        for (var i = 0; i < 1; i++) {
            tab_dice.push(Math.floor(Math.random() * 100) + 1)
        }
        var wyswietl = "Wynik twoich rzutów to: <br>| " + tab_dice.join(" | ") + " |" + ""
        $("#wynik_kosci").css("flex", "6");
        $("#wynik_kosci_k20").css("flex", "0");
        $("#wynik_kosci").html(wyswietl)
        wyswietl = "<div>" + wyswietl + "</div>"
        Net.sendToAdmin(wyswietl)
    })



    $("#avatar_postaci").on("click", function () {
        swal({
            title: "Link bezpośredni do avatara postaci",
            //text: "Write something interesting:",
            input: "text",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "link"
        }).then((input) => {
            if (input.value === false) return false;

            if (input.value === "") {
                swal.showInputError("Nie zostawiaj tego pola pustego!");
                return false
            }
            const data = {
                action: "set_avatar",
                url: input.value,
                character: $("#wybierz_postac").val()
            }

            return Net.ajax(data, "php/set_database.php")
                .then(() => swal("", "nowy avatar zapisany" + $("#wybierz_postac").val() + "", "success"))
        })
    })

    $('.movable').draggable({
        cancel: ''
    });
    $("#notatnik").draggable({
        delay: 100
    });
    $("#notatnik").on("click", function (e) {
        var $this = $(this);
        if ($(this).find("textarea").length) return;
        var $p = $this.find("pre");
        var $textarea = $('<textarea/>').val($p.text());
        $p.replaceWith($textarea);
        $textarea.focus();
    });
    $("#notatnik").on("blur", "textarea", function () {
        // Replace textarea with paragraph
        var $textarea = $(this);
        localStorage.setItem("notatnik", JSON.stringify($textarea.val()))
        //var string_textarea = JSON.stringify($textarea.val())
        var strin = $textarea.val()
        var string = strin.replace(/^"(.*)"$/, '$1');
        //.replace(/\\r\\n/g, "<br />")
        var $p = $('<pre/>').text(string);
        $textarea.replaceWith($p);
        const data = {
            action: "set_notes",
            text: string,
            character: $("#wybierz_postac").val()
        }
        return Net.ajax(data, "php/set_database.php")

    });
    $("#notatnik").resizable();

    $("#book_category").on("change", function () {
        var kategoria = $("#book_category").val()
        if (kategoria == "lorebooki") {
            $(".poradnik").hide()
            $(".lorebook").show()
        }
        if (kategoria == "poradniki") {
            $(".poradnik").show()
            $(".lorebook").hide()
        }
    })

}