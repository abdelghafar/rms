<html>
    <head>

        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $().ready(function () {
                $('button#one').click({text: 'first button'}, handleClick);
                $('button#two').click({text: 'second button'}, handleClick);
            });

            function handleClick(event) {
                alert('Clicked on the ' + event.data.text);
            }
        </script>

    </head>
    <body>
        <button id="one">button#one</button>
        <button id="two">button#two</button>
    </body>
</html>