class Dice {// eslint-disable-line no-unused-vars

    static k20(value) {
        var tab = []
        var wynik = 0;
        for (var i = 0; i < 2; i++) {
            tab.push(random(1, 20))
        }
        if (tab[0] < tab[1]) {
            wynik = tab[0] + value;
        } else {
            wynik = tab[1] + value
        }
        var arr = new Array()
        arr[0] = wynik
        arr[1] = tab[0]
        arr[2] = tab[1]
        console.log(arr)
        return arr
    }

    static k100(value) {
        if (value > 100) {
            var temp_value = value - 100;
            var plus_krit = temp_value / 10
            console.log(value)
        } else {
            plus_krit = 0;
        }
        var tab_suc = []
        var wynik_suc = []
        for (var i = 0; i < 5; i++) {
            tab_suc.push(random(0, 100))


            if (tab_suc[i] <= (5 + plus_krit)) {
                wynik_suc.push("sk")
            } else if (tab_suc[i] < 10 && tab_suc[i] > 5) {
                wynik_suc.push("s")
            } else if (tab_suc[i] <= value && tab_suc[i] < 90) {
                wynik_suc.push("s")
            } else if (tab_suc[i] > value && tab_suc[i] < 90) {
                wynik_suc.push("f")
            } else if (tab_suc[i] >= 90 && tab_suc[i] < 95) {
                wynik_suc.push("f")
            } else if (tab_suc[i] >= 95) {
                wynik_suc.push("fk")
            }

        }
        var s = _.countBy(wynik_suc)
        if (s.fk === undefined) s.fk = 0
        if (s.s === undefined) s.s = 0
        if (s.f === undefined) s.f = 0
        if (s.sk === undefined) s.sk = 0

        var arr = new Array();
        arr[0] = s;
        arr[1] = tab_suc;
        console.log(arr)
        return arr

    }
    static attrib_bonus(wartosc) {
        var temp = 0;
        if (wartosc >= 60) {
            temp = 18
        } else if (wartosc >= 55) {
            temp = 16
        } else if (wartosc >= 50) {
            temp = 14
        } else if (wartosc >= 45) {
            temp = 12
        } else if (wartosc >= 40) {
            temp = 10
        } else if (wartosc >= 35) {
            temp = 8
        } else if (wartosc >= 30) {
            temp = 6
        } else if (wartosc >= 25) {
            temp = 4
        } else if (wartosc >= 20) {
            temp = 2
        }
        return temp;
    }
}

function random(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}