$(document).ready(function () {
    var data = {
        generalStat: [],
        mainStats: []
    }
    console.log(data)
    var statCounter = 0;
    var statGeneralCounter = 0;
    var tableCounter = 0;
    var addTableCounter = 0;
    var generalStats = [null]
    const firstHelpText = "<p>Najpierw musisz utworzyć potrzebne ci atrybuty, wpisujesz ich nazwę, dobrze by nie posiadały polskich znaków, jeśli chcesz by posiadał bonus do rzutu zaznacz kwadracik przy nazwie, jeśli skończyłeś edytować pojedyńczy atrybu wciśnij ok. Gdy skończyłeś edytować kliknij zakończ aby przejść dalej.</p>"
    const secondtHelpText = "<p>Dobra robota, teraz będzie nieco bardziej skomplikowanie. Pole tuż obok przycisku 'edytuj' jest nazwą danego drzewka umiejetności. Po kliknięciu przycisku 'dodaj umiejętność' dodawać się będą po kolei nowe pola do wypełnienia. Tak jak poprzedni, pierwszy element to nazwa danej umiejętności następnie z menu wyboru zaznaczasz który atrybut ma być bonusem dla danej umiejętności, albo zostawiasz puste. Kolejna opcja to też tak jak było wcześniej wybór czy dana umiejętność ma mieć bonus do rzutu, gdy dana umiejętność jest gotowa kliknij 'ok'. Aby dodać więcej drzewek umiejętności musisz kliknać na duży przycisk po prawej stronie. I wszystko powtarzasz tak jak wcześniej, jeśli jednak przypomniało ci się że w poprzednim drzewku brakuje jakiejś umiejętności musisz kliknąć 'edycja' w danym drzewku i postępować tak jak wcześniej, kolor zielony pokazuje ci które drzewko aktualnie edytujesz tzn. dodajesz nowe umiejętności.</p>"
    
    $("#helpDiv").html(firstHelpText)
    $("#stats_config").hide()

    $("#addStatGeneral").on("click", function () {
        $('#generalStats').append("<div class='statPrepare' ><input type='text' id='statGeneral_" + statGeneralCounter + "'><input type='checkbox' id='statGeneralBonus_" + statGeneralCounter + "' ><button class='statGeneralAccept'>ok</button></div>")
        statGeneralCounter++
    })
    $(document).on("click", ".statGeneralAccept", function (e) {
        console.log($(this).parent().children().attr('id').split("_"))
        console.log($(e.target).parent()[0].children[0].value)
        console.log($(e.target).parent()[0].children[1].checked)

        const id = $(this).parent().children().attr('id').split("_")
        const ID = id[1]
        const statName = $(e.target).parent()[0].children[0].value
        const statBonus = $(e.target).parent()[0].children[1].checked
        generalStats.push(statName)
        const array = [statName, statBonus]
        data.generalStat.push(array)

        console.log(generalStats)

        $(this).parent().html("<div class='statPrepare' id='generalStats"+ID+"'><span class='statName' >nazwa atrybutu: " + statName + " | bonus do rzutów?: " + (statBonus ? 'tak' : 'nie') + " </span><button class='statDelete'>delete</button><button class='statEdit'>edit</button></div>")
    })


    $("#stats_config").append("<button class='addStatTable' style='flex:1;'>+</button>")
    $(document).on("click", ".addStatTable", function () {
        tableCounter++
        addTableCounter++;
        // console.log($(this).parent())
        data.mainStats.push([])
        $('.addStatTable').remove()
        $('#stats_config').append("<div id='statTable" + addTableCounter + "' style='flex:1; border:1px solid blue;'><input type='text' class='tableName'><button class='editTable'>edytuj</button> </div>")
        $("#stats_config").append("<button class='addStatTable' style='flex:1;'>+</button>")
        statCounter = 0;
    })
    
    $("#addStat").on("click", function () {
        // var select = $('<select/>');
        // for (var i in generalStats) {
        //     select.append($('<option/>').html(generalStats[i]));
        // }
        var select = $("<select id='attrbBonus'>");
        for (let i = 0; i < generalStats.length; i++) {
            select.append('<option val=' + generalStats[i] + '></option>')
        }
        select.append("</select>")
        // console.log(select[0])
        $('#statTable' + tableCounter).append("<div class='statPrepare' id='" + statCounter + "_" + tableCounter + "' ><input style='width:100px;' type='text' id='statName" + tableCounter + "'><select class = 'attrb" + statCounter + "_" + tableCounter + "' ></select><input type='checkbox' id='statBonus" + tableCounter + "' ><button class='statAccept'>ok</button></div>")
        $.each(generalStats, function (key, value) {
            $('.attrb' + statCounter + "_" + tableCounter)
                .append($("<option></option>")
                    .attr("value", value)
                    .text(value));
        });
        statCounter++;
    })
    var temp;
    $(document).on("click", ".editTable", function (e) {
        // console.log($(this).parent().css("background", "rgba(52, 73, 94, 0.8)"))
        $(".editTable").parent().css("background", "rgba(52, 73, 94, 0.8)")
        temp = $(this).parent().css("background", "green")

        const tableID = $(this).parent().attr('id').split("") || 0
        const arrayPos = $(this).parent().attr('id').split("").length - 1 || 0
        // console.log(tableID[arrayPos])
        tableCounter = tableID[arrayPos]
        // statCounter = parseInt($(this).parent().children().last().attr('id').split("_")[0]) + 1 
        if (parseInt($(this).parent().children().last().attr('id').split("_")[0]) == "undefined") {
            statCounter = 0;
        }
        else{
            statCounter = parseInt($(this).parent().children().last().attr('id').split("_")[0])
        }
        console.log(statCounter)
    })
    $(document).on("click", ".statDelete", function(e){
        console.log($(this).parent().attr('id').split("_"))
        $(this).parent().remove()
    })
    $(document).on("click", ".statEdit", function (e) {
        console.log($(this).parent())
        
    })
    $(document).on("click", ".statAccept", function (e) {
        const id = $(this).parent().attr('id').split("_")
        const tableID = id[1]
        const fieldID = parseInt(id[0])
        const statName = $(e.target).parent()[0].children[0].value
        const attrbName = $(e.target).parent()[0].children[1].value
        const statBonus = $(e.target).parent()[0].children[2].checked
        const array = [fieldID, statName, attrbName, statBonus]
        data.mainStats[tableID].push(array)
       
        console.log(id)
        $(this).parent().html("<div class='statPrepare' id='" + fieldID + "_" + tableID + "'><span class='statName' >nazwa atrybutu: " + statName + " | bonus do rzutów?: " + (statBonus ? 'tak' : 'nie') + " </span><button class='statDelete'>delete</button><button class='statEdit'>edit</button></div>")
    })
    $(document).on("click", ".endStat", function (e) {
        var array =[]
        var inputs = $(".tableName");
        for (var i = 0; i < inputs.length; i++) {
            array.push($(inputs[i]).val());
        }
        data.mainStats.tableLength = addTableCounter + 1
        console.log(array)
        data.mainStats.tableNames = array;
        for (let k = 0; k < data.mainStats.length; k++) {
            data.mainStats[k].sort(function (a, b) {
                return b[0] < a[0]
            })
            
        }
        console.log(data)
        const div = "<div id='staty' class='hover'><span>Atrybuty:</span><hr></div>"
        var bonus = ""
        $("#result").append(div)
        for (let i = 0; i < data.generalStat.length; i++) {
            if (data.generalStat[i][1]) {
                bonus = "<input class='mod_suc' type='number'>"
            }
            else {
                bonus = ""
            }
            $("#staty").append("<div class='stat def'><label>" + data.generalStat[i][0] + "<input id='" + data.generalStat[i][0] + "' type='number' name='umiejętność'></label><button>Rzuć</button>" + bonus + "</div>")
        }
        
        for (let i = 0; i < data.mainStats.length; i++) {
            var begin = "<div id='lista_um_" + array[i] + "' class='hover'><span>Drzewo " + array[i] + ":</span><hr>"
            $("#staty").append(begin)
            
            for (let j = 0; j < data.mainStats[i].length; j++) {
                if (data.mainStats[i][j][3]) {
                    bonus = "<input class='mod_suc' type='number'>"
                }
                else {
                    bonus = ""
                }
                var string = "<div class='stat " + data.mainStats[i][j][2] + "'><label> " + data.mainStats[i][j][1] + "<input id='" + data.mainStats[i][j][1] + "' type='number' name='umiejętność'></label><button>Rzuć</button>"+bonus+"</div>"
                $("#lista_um_" + array[i]).append(string)
                
            }
            $("#staty").append("</div>")
        }
        $("#result").append()
        

    })
    $(document).on("click", ".endStatGeneral", function (e) {
        console.log(data)
        $("#generalStats").hide()
        $("#stats_config").show()
        $("#helpDiv").html(secondtHelpText)
        data.mainStats.push([])
       
    })
})
