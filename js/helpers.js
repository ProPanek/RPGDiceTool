 String.prototype.escapeDiacritics = function()
  {
      return this.replace(/ą/g, 'a').replace(/Ą/g, 'A')
          .replace(/ć/g, 'c').replace(/Ć/g, 'C')
          .replace(/ę/g, 'e').replace(/Ę/g, 'E')
          .replace(/ł/g, 'l').replace(/Ł/g, 'L')
          .replace(/ń/g, 'n').replace(/Ń/g, 'N')
          .replace(/ó/g, 'o').replace(/Ó/g, 'O')
          .replace(/ś/g, 's').replace(/Ś/g, 'S')
          .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
          .replace(/ź/g, 'z').replace(/Ź/g, 'Z');
  }

function toLocalStorage() {
    var inputs_staty = $(".stat input");
    var mod_staty = new Array()
    for (var i = 0; i < inputs_staty.length; i++) {
        mod_staty.push(parseInt($(inputs_staty[i]).val()))
    }
    var inputs_walka = $(".walka input");
    var mod_walka = new Array()
    for (var i = 0; i < inputs_walka.length; i++) {
        mod_walka.push(parseInt($(inputs_walka[i]).val()))
    }
    var inputs_magia = $(".magia input");
    var mod_magia = new Array()
    for (var i = 0; i < inputs_magia.length; i++) {
        mod_magia.push(parseInt($(inputs_magia[i]).val()))
    }
    var inputs_zbroja = $(".zbroja input");
    var mod_zbroja = new Array()
    for (var i = 0; i < inputs_zbroja.length; i++) {
        mod_zbroja.push(parseInt($(inputs_zbroja[i]).val()))
    }
    var mod_arr = [$("#mod_z").val(), $("#mod_r").val(), $("#mod_w").val(), $("#mod_d").val()]
    var loginn = []
    loginn.push($("#login").val())
    localStorage.setItem("mods", JSON.stringify(mod_arr))
    localStorage.setItem("staty", JSON.stringify(mod_staty))
    localStorage.setItem("staty_walka", JSON.stringify(mod_walka))
    localStorage.setItem("staty_magia", JSON.stringify(mod_magia))
    localStorage.setItem("staty_zbroja", JSON.stringify(mod_zbroja))
    localStorage.setItem("login", JSON.stringify(loginn))
}

function time() {
    const data = new Date()
    var h = data.getHours()
    var m = data.getMinutes()
    var s = data.getSeconds()

    if (h < 10) {
        h = "0" + h
    }
    if (m < 10) {
        m = "0" + m
    }
    if (s < 10) {
        s = "0" + s
    }
    return (h + ":" + m + ":" + s)
}

window.onbeforeunload = function () {
    toLocalStorage()
};
