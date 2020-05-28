<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Watching Me</title>
</head>
<body>

<p id="demo"></p>

<script>

var x = document.getElementById("demo");
var n=0;
var countlat=0;
var countlong=0;
var avglat = 0;
var avglong=0;

function getLocation()
{
  // Check whether browser supports Geolocation API or not
  if (navigator.geolocation) { // Supported

	var positionOptions = {
	  timeout : Infinity,
	  maximumAge : 0,
	  enableHighAccuracy : true
	}

	navigator.geolocation.watchPosition(showPosition, catchError, positionOptions);

  } else { // Not supported
	alert("Oops! This browser does not support HTML Geolocation.");
  }
}
//function getPosition(position)
//{
//  document.getElementById("location").innerHTML =
//	  "Latitude: " + position.coords.latitude + "<br>" +
//	  "Longitude: " + position.coords.longitude;
//}

function catchError(positionError) {
  switch(positionError.code)
  {
	case positionError.TIMEOUT:
	  alert("The request to get user location has aborted as it has taken too long.");
	  break;
	case positionError.POSITION_UNAVAILABLE:
	  alert("Location information is not available.");
	  break;
	case positionError.PERMISSION_DENIED:
	  alert("Permission to share location information has been denied!");
	  break;
	default:
	  alert("An unknown error occurred.");
  }
}

//Averaging ten instances then checking for location
function showPosition(position) {
    if(n<10){
    n++;
    var alat=position.coords.latitude;
    var along=position.coords.longitude;
    alat=Math.round(alat * 100000) / 100000;
    along=Math.round(along * 100000) / 100000;
    countlat=countlat + alat;
    countlong=countlong + along;
    countlat=Math.round(countlat * 100000) / 100000;
    countlong=Math.round(countlong * 100000) / 100000;

    avglat = (countlat/n);
    avglong = (countlong/n);

    avglat=Math.round(avglat * 100000) / 100000;
    avglong=Math.round(avglong * 100000) / 100000;

    x.innerHTML="<br><br>Lat: " + alat +
    "<br>Readings : " + n +".....Added Lats : " + countlat + "......Avg Lat : " + avglat +
    "<br><br>Long: " + along +
    "<br>Readings : " + n +".....Added Longs : " + countlong + "......Avg Long : " + avglong+
    "Latitude: " + avglat +
    "<br>Longitude: " + avglong + "<br><br>Accuracy : " + position.coords.accuracy;

    /////check for avg inside the range
            //kens mailbox coordinates
             if(avglong>-84.87486 && avglong<-84.87456 && avglat>33.65105 && avglat<33.65135)
             //rodneys building coordinates
           // if(avglong>-84.84828 && avglong<-84.84798 && avglat>33.6197 && avglat<33.6200)
    {
    x.innerHTML= "<img src='https://dixiewing.org/wp-content/uploads/2017/01/CAF-FG-1d-Corsair_Photo-by-Luigino-Caliaro_WM.jpeg' alt='W3Schools.com' style='width:250px;height:200px;'>" +
    "Latitude: " + avglat +
    "<br>Longitude: " + avglong + "<br><br>Accuracy : " + position.coords.accuracy;
    }



        if(n==5){

    n=0;
    avglong=0;
    avglat=0;
    countlat=0;
    countlong=0;

        }
      }

}
///////////////////////////////


</script>
<h1>Finding Me</h1>
<button onclick="getLocation()">Where am I?</button>
<p id="location"></p>
</body>
</html>
