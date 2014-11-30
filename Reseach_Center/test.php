
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="keywords" content="jQuery Tabs, Tabs Widget, TabView" />
        <meta name="description" content="jqxTabs enables you to simplify input tasks by creating a series of pages with validation." />
        <title id='Description'>jqxTabs enables you to simplify input tasks by creating a series of pages with validation. </title>
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/globalization/jquery.global.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcombobox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtabs.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcheckbox.js"></script>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function() {
                var theme = "";

                //Creating wizard module
                var wizard = (function() {

                    //Adding event listeners
                    var _addHandlers = function() {
                        $('#usernameInput').keyup(function() {
                            wizard.validate(true);
                        });
                        $('#usernameInput').change(function() {
                            wizard.validate(true);
                        });
                        $('#usernameInput').change(function() {
                            wizard.validate(true);
                        });
                        $('#passwordInput').keyup(function() {
                            wizard.validate(true);
                        });
                        $('.nextButton').click(function() {
                            wizard.validate(true);
                            $('#jqxTabs').jqxTabs('next');
                        });
                        $('.backButton').click(function() {
                            wizard.validate(true);
                            $('#jqxTabs').jqxTabs('previous');
                        });
                        $('#acceptCheckBox').on('change', function(event) {
                            wizard.validate(true);
                        });
                        $('#products').on('change', function(event) {
                            wizard.validate(true);
                            var selectedItems = $('#products').jqxListBox('selectedIndexes'),
                                    count = selectedItems.length;
                            $('#orderContainer').children().remove();
                            while (count) {
                                count--;
                                if (typeof selectedItems[count] !== 'undefined' &&
                                        selectedItems[count] !== -1) {
                                    $('#orderContainer').prepend('<div style="width: 190px; height: 20px;">' + wizard.config.source[selectedItems[count]].html + '</div>');
                                }
                            }
                        });
                        $('#products').on('unselect', function(event) {
                            wizard.validate(true);
                        });
                    };

                    //Checking if any product have been selected
                    var _isItemSelected = function(array) {
                        var count = array.length;
                        if (count === 0) {
                            return false;
                        }
                        while (count) {
                            count -= 1;
                            if (array[count] !== -1 &&
                                    typeof array[count] !== 'undefined') {
                                return true;
                            }
                        }
                        return false;
                    };

                    return {
                        //Listbox's source
                        config: {
                            source: [
                                {html: "<div style='height: 20px; float: left;'><img style='float: left; margin-top: 2px; margin-right: 5px;' src='../../images/numberinput.png'/><span style='float: left; font-size: 13px; font-family: Verdana Arial;'>jqxNumberInput</span></div>", title: 'jqxNumberInput'},
                                {html: "<div style='height: 20px; float: left;'><img style='float: left; margin-top: 2px; margin-right: 5px;' src='../../images/progressbar.png'/><span style='float: left; font-size: 13px; font-family: Verdana Arial;'>jqxProgressBar</span></div>", title: 'jqxProgressBar'},
                                {html: "<div style='height: 20px; float: left;'><img style='float: left; margin-top: 2px; margin-right: 5px;' src='../../images/calendar.png'/><span style='float: left; font-size: 13px; font-family: Verdana Arial;'>jqxCalendar</span></div>", title: 'jqxCalendar'},
                                {html: "<div style='height: 20px; float: left;'><img style='float: left; margin-top: 2px; margin-right: 5px;' src='../../images/button.png'/><span style='float: left; font-size: 13px; font-family: Verdana Arial;'>jqxButton</span></div>", title: 'jqxButton'},
                                {html: "<div style='height: 20px; float: left;'><img style='float: left; margin-top: 2px; margin-right: 5px;' src='../../images/dropdownlist.png'/><span style='float: left; font-size: 13px; font-family: Verdana Arial;'>jqxDropDownList</span></div>", title: 'jqxDropDownList'},
                                {html: "<div style='height: 20px; float: left;'><img style='float: left; margin-top: 2px; margin-right: 5px;' src='../../images/listbox.png'/><span style='float: left; font-size: 13px; font-family: Verdana Arial;'>jqxListBox</span></div>", title: 'jqxListBox'},
                                {html: "<div style='height: 20px; float: left;'><img style='float: left; margin-top: 2px; margin-right: 5px;' src='../../images/tooltip.png'/><span style='float: left; font-size: 13px; font-family: Verdana Arial;'>jqxTooltip</span></div>", title: 'jqxTooltip'}
                            ]
                        },
                        //Initializing the wizzard - creating all elements, adding event handlers and starting the validation
                        init: function() {
                            $('#jqxTabs').jqxTabs({rtl:true,height: 230, width: 500, theme: theme, keyboardNavigation: false});
                            $('#acceptCheckBox').jqxCheckBox({width: 250, theme: theme});
                            $('#nextButtonInfo').jqxButton({width: 50, theme: theme});
                            $('#nextButtonBasket').jqxButton({width: 50, theme: theme});
                            $('#backButtonBasket').jqxButton({width: 50, theme: theme});
                            $('#backButtonReview').jqxButton({width: 50, theme: theme});
                            $("#products").jqxListBox({source: this.config.source, width: '490px', height: '130px', theme: theme, multiple: true});
                            _addHandlers();
                            this.validate();
                            this.showHint('Validation hints.');
                        },
                        //Validating all wizard tabs
                        validate: function(notify) {
                            if (!this.firstTab(notify)) {
                                $('#jqxTabs').jqxTabs('disableAt', 1);
                                $('#jqxTabs').jqxTabs('disableAt', 2);
                                return;
                            } else {
                                $('#jqxTabs').jqxTabs('enableAt', 1);
                            }
                            if (!this.secondTab(notify)) {
                                $('#jqxTabs').jqxTabs('disableAt', 2);
                                return;
                            } else {
                                $('#jqxTabs').jqxTabs('enableAt', 2);
                            }
                        },
                        //Displaying message to the user
                        showHint: function(message, selector) {
                            if (typeof selector === 'undefined') {
                                selector = '.hint';
                            }
                            if (message === '') {
                                message = 'You can continue.';
                            }
                            $(selector).html('<strong>' + message + '</strong>');
                        },
                        //Validating the first tab
                        firstTab: function(notify) {
                            var username = $('#usernameInput').val(),
                                    password = $('#passwordInput').val(),
                                    message = '';
                            if (username.length < 3) {
                                message += 'You have to enter valid username. <br />';
                            }
                            if (password.length < 3) {
                                message += 'You have to enter valid password. <br />';
                            }
                            if (!$('#acceptCheckBox').jqxCheckBox('checked')) {
                                message += 'You have to accept the terms. <br />';
                            }
                            if (message !== '') {
                                if (notify) {
                                    this.showHint(message, '#hintSection');
                                }
                                return false;
                            }
                            this.showHint('You can continue.', '#hintSection');
                            return true;
                        },
                        //Validating the second tab
                        secondTab: function() {
                            var products = $('#products').jqxListBox('selectedIndex');
                            if (!_isItemSelected($('#products').jqxListBox('selectedIndexes'))) {
                                this.showHint('You have to select at least one item.', '#hintBasket');
                                return false;
                            } else {
                                this.showHint('You can continue.', '#hintBasket');
                            }
                            return true;
                        }
                    }
                }());

                //Initializing the wizard
                wizard.init();
            });
        </script>
        <style type="text/css">
            #form
            {
                height: 100px;
                float: left;
                margin-top: 30px;
                margin-left: 20px;
            }
            .inputContainer
            {
                width: 150px;
            }
            .formInput
            {
                width: 150px;
                outline: none;
            }
            #hintWrapper
            {
                height: 130px;
                float: right;
            }
            #hintSection
            {
                float: left;
                margin-top: 30px;
                margin-right: 20px;
                padding: 5px;
                width: 225px;
            }
            #checkBoxWrapper
            {
                float: left;
                margin-left: 20px;
                margin-top: 30px;
            }
            #section
            {
                margin: 5px;
            }
            #sectionButtonsWrapper
            {
                float: right;
                margin-top: 30px;
                margin-right: 10px;
                width: 115px;
            }
            #hintBasket
            {
                margin-left: 20px;
                margin-top: 7px;
                float: left;
                padding: 5px;
            }
            .basket div
            {
                position: relative;
            }
            .nextButton
            {
                float: right;
                margin-left: 0px;
            }
            .backButton
            {
                float: left;
                margin-left: 10px;
            }
            #basketButtonsWrapper
            {
                float: right;
                margin-top: 30px;
                margin-right: 10px;
                width: 115px;
            }
            #selectedProductsHeader
            {
                margin-left: 20px;
                float: left;
                width: 200px;
            }
            #selectedProductsButtonsWrapper
            {
                float: right;
                margin-right: 10px;
                width: 115px;
                margin-top: 160px;
            }
            #products
            {
                border: none;
            }
        </style>
    </head>
    <body class='default'>
        <div id='jqxWidget'>
            <div id='jqxTabs'>
                <ul>
                    <li style="margin-left: 30px;">Personal info</li>
                    <li>Shopping basket</li>
                    <li>Review order</li>
                </ul>
                <div class="section">
                    <div id="form">
                        <div class="inputContainer">
                            Username:
                            <input class="formInput" type="text" id="usernameInput" /></div>
                        <div class="inputContainer">
                            Password:
                            <input class="formInput" type="password" id="passwordInput" /></div>
                    </div>
                    <div id="hintWrapper">
                        <div id="hintSection" class="hint">
                        </div>
                    </div>
                    <div id="checkBoxWrapper">
                        <div id="acceptCheckBox">
                            I accept the terms and conditions</div>
                    </div>
                    <div id="sectionButtonsWrapper">
                        <input type="button" value="Next" class="nextButton" id="nextButtonInfo" />
                    </div>
                </div>
                <div class="section">
                    <div id="products">
                    </div>
                    <div class="hint" id="hintBasket">
                    </div>
                    <div id="basketButtonsWrapper">
                        <input type="button" value="Back" class="backButton" id="backButtonBasket" />
                        <input type="button" value="Next" class="nextButton" id="nextButtonBasket" />
                    </div>
                </div>
                <div class="section">
                    <div id="selectedProductsHeader">
                        <h4>Selected products</h4>
                        <div id="orderContainer">
                        </div>
                    </div>
                    <div id="selectedProductsButtonsWrapper">
                        <input type="button" value="Back" id="backButtonReview" class="backButton" />
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
