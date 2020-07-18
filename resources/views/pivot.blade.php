
<!DOCTYPE html>
<html>
<head>
    <title>Pivot Demo</title>
    <!-- external libs from cdnjs -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <!-- PivotTable.js libs from ../dist -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pivot.css') }}">
    <script type="text/javascript" src="{{ asset('js/pivot.js') }}"></script>
    <style>
        body {font-family: Verdana;}
    </style>

    <!-- optional: mobile support with jqueryui-touch-punch -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

</head>
<body>
<script type="text/javascript">
    // This example shows how to prepopulate the UI on
    // load using the "Canadian Parliament 2012" dataset.

    $(function(){
        var mps = {!! json_encode( $data, JSON_NUMERIC_CHECK ); !!};
        $("#output").pivotUI(mps);
    });
</script>

<div id="output" style="margin: 30px;"></div>

</body>
</html>
