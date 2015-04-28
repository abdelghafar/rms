$(document).ready(function () {
    var mytheme = 'energyblue';

    var NationalitiesSrc =
    {
        datatype: "json",
        datafields: [
            {name: 'title_en'},
            {name: 'seq_id'}
        ],
        url: 'Data/Nationalities.php'
    };

    $(".textbox").jqxInput({height: 30, width: 240, minLength: 1, theme: mytheme});
    dataAdapter = new $.jqx.dataAdapter(NationalitiesSrc);
    $("#Nationalities").jqxDropDownList({source: dataAdapter, selectedIndex: 81, width: '300px', height: '30px', displayMember: 'title_en', valueMember: 'seq_id', theme: mytheme});
    $('#Nationalities').on('change', function (event) {
        var args = event.args;
        if (args) {
            // index represents the item's index.
            var index = args.index;
            var item = args.item;
            // get item's label and value.
            var label = item.label;
            var value = item.value;
            $('#NationalitiesValue').val(value);
        }
    });
    $("#DateOfBirth").jqxDateTimeInput({width: '301px', height: '30px', theme: mytheme, formatString: "dd-MM-yyyy"});
    $('#DateOfBirthValue').val($('#DateOfBirth').jqxDateTimeInput('getText'));
    $('#DateOfBirth').on('change', function (event) {
        $('#DateOfBirthValue').val($('#DateOfBirth').jqxDateTimeInput('getText'));
    });
    $("#NIExpireDate").jqxDateTimeInput({width: '301px', height: '30px', theme: mytheme, formatString: "dd-MM-yyyy"});
    $('#NIExpireDateValue').val($('#NIExpireDate').jqxDateTimeInput('getText'));
    $('#NIExpireDate').on('change', function (event) {
        $('#NIExpireDateValue').val($('#NIExpireDate').jqxDateTimeInput('getText'));
    });
    $("#Update").jqxButton({width: '200px', height: '30', theme: mytheme});
});
