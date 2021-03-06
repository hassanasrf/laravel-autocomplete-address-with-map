<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Google Autocomplete Address Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
  
<body>
    <div class="container mt-3">
        <h2>Laravel
        <img src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" width="100" alt="">
        Autocomplete Address</h2>
        <form action="">
            @csrf
            <div class="form-group w-75">
                <label>Location/City/Address</label>
                <input type="text" name="autocomplete" id="autocomplete" class="form-control" value="{{Session::get('name')}}" placeholder="Choose Location">
                <span class="input-group-addon">
                <i class="fa fa-refresh fa-spin"></i>
            </span>
            </div>
      
            <div class="form-group" id="latitudeArea" style="display: none;">
                <label>Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control">
            </div>
            <div class="form-group" id="longtitudeArea" style="display: none;">
                <label>Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control">
            </div>
              <table>
                <tr>
                  <td>Terms & Condition*</td>
                  <td><input type=checkbox name=agree value=yes id=c1></td>
                </tr>
              </table>
            <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
        </form>
        <div class="mt-3">
            <iframe src="https://maps.google.com/maps?q={{Session::get('lat')}},{{Session::get('lang')}}&hl=es&z=14&amp;output=embed" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <span><strong>Location: </strong>{{Session::get('name')}}</span><br>
            <span><strong>Latitude: </strong>{{Session::get('lat')}}</span><br>
            <span><strong>Longitude: </strong>{{Session::get('lang')}}</span>
        </div>
    </div>
    <div class="card-footer text-center">
        <span><a href="https://github.com/hassanasrf">&#128151;</a></span>
    </div>


  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places" ></script>
    <script>
        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);
  
        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
  
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
  
                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>

    <script>
        function formValidation(oEvent) {
            oEvent = oEvent || window.event;
            var txtField = oEvent.target || oEvent.srcElement;

            var t1ck = true;
            var msg = " ";
            if (document.getElementById("autocomplete").value.length < 3) { t1ck = false;
                msg = msg + "Your name should be minimun 3 char length"; }
            /*
            if (!document.getElementById("r1").checked && !document.getElementById("r2").checked) { t1ck = false;
                msg = msg + " Select your Gender"; }
            if (document.getElementById("s1").value.length < 3) { t1ck = false;
                msg = msg + " Select one of the games "; }
            */
            if (!document.getElementById("c1").checked) { t1ck = false;
                msg = msg + " You must agree to terms & conditions "; }

            //alert(msg + t1ck);

            if (t1ck) { document.getElementById("submitButton").disabled = false; } else { document.getElementById("submitButton").disabled = true; }
            }

            /*function resetForm() {
                document.getElementById("submitButton").disabled = true;
                var frmMain = document.forms[0];
                frmMain.reset();
            }*/

            window.onload = function() {

            var btnSignUp = document.getElementById("submitButton");
            //var btnReset = document.getElementById("btnReset");

            var t1 = document.getElementById("autocomplete");
            //var r1 = document.getElementById("r1");
            //var r2 = document.getElementById("r2");
            //var s1 = document.getElementById("s1");
            var c1 = document.getElementById("c1");

            var t1ck = false;
            document.getElementById("submitButton").disabled = true;
            t1.onkeyup = formValidation;
            //r1.onclick = formValidation;
            //r2.onclick = formValidation;
            //s1.onclick = formValidation;
            c1.onclick = formValidation;
            //btnReset.onclick = resetForm;
        }
    </script>
</body>
</html>