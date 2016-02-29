<h1>Route Planner</h1>
<script type="text/javascript">
    jQuery.noConflict();
    function onBodyLoad()
    {
        google.load("maps", "3", {callback: init, other_params: "sensor=false"});
    }

    function init()
    {
        if (google.loader.ClientLocation != null) {
            latLng = new google.maps.LatLng(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude);
            loadAtStart(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude, 8);
        } else {
            loadAtStart(37.4419, -122.1419, 8);
        }
    }

    function toggle(divId)
    {
        var divObj = document.getElementById(divId);
        if (divObj.innerHTML == "") {
            divObj.innerHTML = document.getElementById(divId + "_hidden").innerHTML;
            document.getElementById(divId + "_hidden").innerHTML = "";
        } else {
            document.getElementById(divId + "_hidden").innerHTML = divObj.innerHTML;
            divObj.innerHTML = "";
        }
    }

    function setPollHidden()
    {
        jQuery('.poll').hide();
        jQuery.cookie('hideCallForPhotos', 'true', {path: '/', expires: 365});
    }

    jQuery(function () {
        jQuery("#accordion").accordion({
            collapsible: true,
            autoHeight: false,
            clearStyle: true
        });
        jQuery("input:button").button();
        jQuery("#dialogProgress").dialog({
            height: 140,
            modal: true,
            autoOpen: false
        });
        jQuery("#progressBar").progressbar({value: 0});
        jQuery("#dialogTomTom").dialog({
            height: 480,
            width: 640,
            modal: true,
            autoOpen: false
        });
        jQuery("#dialogGarmin").dialog({
            height: 480,
            width: 640,
            modal: true,
            autoOpen: false
        });
        jQuery('.myMap').height(jQuery(window).height() - 100);
    });

    (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = '<?php echo base_url(); ?>js/map_routing/plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();

</script>
<script type="text/javascript">
    /* <![CDATA[ */
    (function () {
        var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = '<?php echo base_url(); ?>js/map_routing/load.js?mode=auto';
        t.parentNode.insertBefore(s, t);
    })();
    /* ]]> */</script>

<script type="text/javascript" >
    function total_sum(clicked)
    {
        var dirRes = tsp.getGDirections();
        var dir = dirRes.routes[0];
        var pathStr = formatTime(getTotalDuration(dir));
        // Raw path output with labels
        var labels = tsp.getLabels();
        var order = tsp.getOrder();
        var bestPathLabelStr = "";
        if (labels[order[0]] == null) {
            bestPathLabelStr += order[0];
        } else {
            bestPathLabelStr += labels[order[0]];
        }
        bestPathLabelStr += ": " + dir.legs[0].start_location.toString() + "\n";
        for (var i = 0; i < dir.legs.length; ++i) {
            if (labels[order[i + 1]] == null) {
                bestPathLabelStr += order[i + 1];
            } else {
                bestPathLabelStr += labels[order[i + 1]];
            }
            bestPathLabelStr += ": " + dir.legs[i].end_location.toString() + "\n";
        }
        save_to_db(pathStr, bestPathLabelStr);
    }

    function save_to_db(pathStr, bestPathLabelStr)
    {

        $.ajax({
            url: '<?php echo base_url('map_routing/insert_values'); ?>',
            type: 'post',
            data: {
                'pathStr': pathStr,
                'bestPathLabelStr': bestPathLabelStr
            },
            success: function (msg) {
                console.log(msg); // 
            },
            error: function (msg) {
                console.log(msg);
                // console.log(request, error);
            }

        });


    }

</script>

<script type="text/javascript">
    $(function () {
        $('#button1').on('click', function () {
            var walkChecked;

            if ($("#walking").is(':checked')) {
                walkChecked = true;
            } else {
                walkChecked = false;
            }
            directions(0, walkChecked);
        });
    });
    $(function () {
        $('#button2').on('click', function () {
            var walkChecked;

            if ($("#walking").is(':checked')) {
                walkChecked = true;
            } else {
                walkChecked = false;
            }
            directions(1, walkChecked);
        });
    });
</script>

<table class='mainTable'>
    <tr>
        <td class='left' style='vertical-align: top'>
            <div id="leftPanel">
                <div id="accordion" style='width: 300pt'>
                    <h3><a href="#" class='accHeader'>Destinations</a></h3>
                    <div>
                        <form name="address" onSubmit="clickedAddAddress();
                                return false;">
                            Add Location by Address: 
                            <table><tr>

                                    <td><input name="addressStr" type="text"></td>
                                    <td><input type="button" value="Add" onClick="clickedAddAddress()"></tr>
                            </table>
                        </form> or <a href="#" onClick="toggle('bulkLoader');
                                document.listOfLocations.inputList.focus();
                                document.listOfLocations.inputList.select();
                                return false;">
                            Add Multiple Addresses</a>.
                        <div id="bulkLoader"></div>
                    </div>

                    <h3><a href="#" class='accHeader'>Route Options</a></h3>
                    <div>
                        <form name="travelOpts">
                            <input id="walking" type="checkbox" /> Walking<br>
                            <?php
//                            <input id="bicycling" type="checkbox"/> Bicycling<br>
//                            <input id="avoidHighways" type="checkbox"/> Avoid highways<br>
//                            <input id="avoidTolls" type="checkbox"/> Avoid toll roads><br>                                    
                            ?>
                        </form>
                    </div>

                    <h3><a href="#" class='accHeader'>Export</a></h3>
                    <div>
                        <div id="exportGoogle"></div>
                        <div id="exportDataButton"></div>
                        <div id="exportData"></div>
                        <div id="exportLabelButton"></div>
                        <div id="exportLabelData"></div>
                        <div id="exportAddrButton"></div>
                        <div id="exportAddrData"></div>
                        <div id="exportOrderButton"></div>
                        <div id="exportOrderData"></div>
                        <div id="garmin"></div>
                        <div id="tomtom"></div>
                        <div id="durations" class="pathdata"></div>
                        <div id="durationsData"></div>
                    </div>

                    <h3><a href="#" class='accHeader'>Edit Route</a></h3>
                    <div>
                        <div id="routeDrag"></div>
                        <div id="reverseRoute"></div>
                    </div>

                </div>

                <input id="button1" class="calcButton" type="button" value="Calculate Fastest Roundtrip" >
                <input id="button2" class="calcButton" type="button" value="Calculate Fastest A-Z Trip" >
                <input id='button3' class="calcButton" type='button' value='Start Over Again' onClick='startOver()'>

                <!--// to get total duration :-->
                <input id='total_sum' class="calcButton" type='button' value='Travelling Time/Coordinates/Addresses' onclick="total_sum()">
                <div id ="value_verify"></div>
                <div id="pass_value"></div>

            </div>
        </td>

        <td class='right' style='vertical-align: top'>
            <div id="map" class="myMap"></div>
            <div id="path" class="pathdata"></div>
            <div id="path_total" class="pathdata_total"></div>
            <div id="my_textual_div"></div>
        </td>
    </tr>
</table>

<!-- Hidden stuff -->
<div id="bulkLoader_hidden" style="visibility: hidden;">
    <form name="listOfLocations" onSubmit="clickedAddList();
            return false;">
        <textarea name="inputList" rows="10" cols="70" 
                  placeholder="One destination per line. 
                  Example : Camberwell VIC 3124, Australia
                  Toorak australia
                  Point Cook australia
                  Hawthorn australia
                  City australia, City Road, Melbourne VIC, Australia"></textarea><br>
        <input type="button" value="Add list of locations" onClick="clickedAddList()">
        <input id='button4' type='button' value='Reset' onClick='startOver()'>
    </form></div>
<div id="exportData_hidden" style="visibility: hidden;"></div>
<div id="exportLabelData_hidden" style="visibility: hidden;"></div>
<div id="exportAddrData_hidden" style="visibility: hidden;"></div>
<div id="exportOrderData_hidden" style="visibility: hidden;"></div>
<div id="durationsData_hidden" style="visibility: hidden;"></div>

<div id="dialogProgress" title="Calculating route...">
    <div id="progressBar"></div>
</div>