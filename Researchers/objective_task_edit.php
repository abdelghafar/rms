<html lang="en">
<head>
    <title id='Description'>The sample illustrates how to style the edited rows and keep their values in an Array.</title>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script> 
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.edit.js"></script>  
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.sort.js"></script>  
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnumberinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/globalization/globalize.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script>
    <script type="text/javascript" src="generatedata.js"></script>
    <style type="text/css">
        .editedRow {
          color: #b90f0f;
          font-style: italic;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var theme = "";

            // prepare the data
            var data = generatedata(200);
            // array which keeps the indexes of the edited rows.
            var editedRows = new Array();

            var source =
            {
                localdata: data,
                datatype: "array",
                updaterow: function (rowid, rowdata, commit) {
                    // that function is called after each edit.

                    var rowindex = $("#jqxgrid").jqxGrid('getrowboundindexbyid', rowid);          
                    editedRows.push({ index: rowindex, data: rowdata });

                    // synchronize with the server - send update command
                    // call commit with parameter true if the synchronization with the server is successful 
                    // and with parameter false if the synchronization failder.
                    commit(true);
                },
                datafields:
                [
                    { name: 'firstname', type: 'string' },
                    { name: 'lastname', type: 'string' },
                    { name: 'productname', type: 'string' },
                    { name: 'available', type: 'bool' },
                    { name: 'quantity', type: 'number' },
                    { name: 'price', type: 'number' },
                    { name: 'date', type: 'date' }
                ]
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            var cellclass = function (row, datafield, value, rowdata) {
                for (var i = 0; i < editedRows.length; i++) {
                    if (editedRows[i].index == row) {
                        return "editedRow";
                    }
                }
            }

            // initialize jqxGrid
            $("#jqxgrid").jqxGrid(
            {
                width: 685,
                source: dataAdapter,
                editable: true,
                theme: theme,
                selectionmode: 'multiplecellsadvanced',
                columns: [
                  { text: 'First Name', columntype: 'textbox', cellclassname: cellclass, datafield: 'firstname', width: 80 },
                  { text: 'Last Name', datafield: 'lastname', cellclassname: cellclass, columntype: 'textbox', width: 80 },
                  { text: 'Product', columntype: 'dropdownlist', cellclassname: cellclass, datafield: 'productname', width: 195 },
                  { text: 'Available', datafield: 'available', cellclassname: cellclass, columntype: 'checkbox', width: 67 },
                  {
				  text: 'Ship Date', datafield: 'date', cellclassname: cellclass, columntype: 'datetimeinput', width: 110, align: 'right', cellsalign: 'right', cellsformat: 'd',
                  validation: function (cell, value) {
                          if (value == "")
                             return true;

                          var year = value.getFullYear();
                          if (year >= 2014) {
                              return { result: false, message: "Ship Date should be before 1/1/2014" };
                          }
                          return true;
                      }
                  },
                  {text: 'Quantity', datafield: 'quantity', cellclassname: cellclass, width: 70, align: 'right', cellsalign: 'right', columntype: 'numberinput',
                      validation: function (cell, value) {
                          if (value < 0 || value > 150) {
                              return { result: false, message: "Quantity should be in the 0-150 interval" };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ decimalDigits: 0, digits: 3 });
                      }
                  },
                  {
                      text: 'Price', datafield: 'price', cellclassname: cellclass, align: 'right', cellsalign: 'right', cellsformat: 'c2', columntype: 'numberinput',
                      validation: function (cell, value) {
                          if (value < 0 || value > 15) {
                              return { result: false, message: "Price should be in the 0-15 interval" };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ digits: 3 });
                      }

                  }
                ]
            });
        });
    </script>
</head>
<body class='default'>
    <div id='jqxWidget'>
        <div id="jqxgrid"></div>
        <div style="font-size: 12px; font-family: Verdana, Geneva, 'DejaVu Sans', sans-serif; margin-top: 30px;">
            <div id="cellbegineditevent"></div>
            <div style="margin-top: 10px;" id="cellendeditevent"></div>
       </div>
    </div>
</body>
</html>