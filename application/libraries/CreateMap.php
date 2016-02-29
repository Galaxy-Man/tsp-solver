<?php 
/**
 * Class TO display Multiple Map 
 * @package		Easfv9
 */
class CreateMap
{
 function __construct()
 {
   $this->compname="";
   $this->address="";
   $this->width=500;
   $this->height=500;
   $this->api="";
   $this->map_id="";
   $this->icon="";
   $this->iconx_position="";
   $this->icony_position="";
   $this->initialzoom=18;
   $this->smallmap=true;
   $this->coord=true;
   $this->lmapcontrol=false;
   $this->coordinates="18.968636543402223, 72.81897068023681";
   $this->image ="";
   $this->add1 ="";
   $this->add2 ="";
   $this->add3  ="";
   $this->phone ="";
   $this->email ="";  
 }
 
 function generate_map()
 {  
     $str = '';
   $str.='
	 
    <script type="text/javascript">
		//<![CDATA[
    var map'.$this->map_id.'; // Global declaration of the map
			var iw = new google.maps.InfoWindow(); // Global declaration of the infowindow
			var lat_longs = new Array();
			var markers = new Array();

    function loadGmap_'.$this->map_id.'() {
				var myLatlng = new google.maps.LatLng('.$this->coordinates.');
				var myOptions = {
			  		zoom: '.$this->initialzoom.',
					center: myLatlng,
			  		mapTypeId: google.maps.MapTypeId.ROADMAP}
				map'.$this->map_id.' = new google.maps.Map(document.getElementById("map'.$this->map_id.'"), myOptions); 
				
				var markerOptions'.$this->map_id.' = {
				position: myLatlng, 
				map: map'.$this->map_id.'		
			};
			
			marker_'.$this->map_id.' = createMarker'.$this->map_id.'(markerOptions'.$this->map_id.');
			
			marker_'.$this->map_id.'.set("content", "<div class=\'gmap_add_wrap\'><div class=\'gmap_add_left\'><a href=\''.$this->website_url.'\'><b>'.addslashes($this->compname).'<\/b><\/a></br/><span><b>Address: <\/b>' .$this->add2.'<\/span></br/><span><b>Phone: <\/b>'.$this->phone.'<\/span></br/><span class=\'gmap_email\'><b>Email:  <\/b>'.$this->email.'<\/span><\/div><a href=\''.base_url().'\' class=\'gmap_comp_logo\' title=\''.addslashes($this->compname).'\'><\/a><\/div>");
			iw.setContent(marker_'.$this->map_id.'.get("content"));
			iw.open(map'.$this->map_id.', marker_'.$this->map_id.');
			google.maps.event.addListener(marker_'.$this->map_id.', "click", function() {
				iw.setContent(this.get("content"));
				iw.open(map'.$this->map_id.', this);
			});
		}
		function createMarker'.$this->map_id.'(markerOptions) {
			var marker = new google.maps.Marker(markerOptions);
			markers.push(marker);
			lat_longs.push(marker.getPosition());
			return marker;
		}
		function streetView'.$this->map_id.'() {
   var myLatlng = new google.maps.LatLng('.$this->coordinates.');
   var panoOptions = {
        position: myLatlng,
        addressControl: false,
        linksControl: false,
        panControl: false,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.LARGE
        },
         pov: {
      heading: 220,
      pitch: 1,
      zoom: 2
         },
        enableCloseButton: false
      };
    
      var panorama = new google.maps.StreetViewPanorama(document.getElementById("streetmap'.$this->map_id.'"), panoOptions);
   }
    //]]>
	</script>';
	$str.='<script type="text/javascript">loadGmap_'.$this->map_id.'();</script>';
	$str.='<script type="text/javascript">streetView'.$this->map_id.'();</script>';
  echo $str;
	}
	
	
 
function set_companyname($comp)
{
  $this->compname=$comp;
}

function set_address($address)
{
  $this->address=$address;
}
function set_email($email)
{
  $this->email=$email;
}

function set_width($width)
{
  $this->width=$width;	
}

function set_height($height)
{
  $this->height=$height;
}

function set_apikey($apikey)
{
  $this->api=$apikey;
}

function set_icon($icon)
{
  $this->icon=$icon;
} 

function seticon_position($x,$y)
{
  $this->iconx_position=$x;
  $this->icony_position=$y;
}

function set_initialzoom($zoom)
{
  $this->initialzoom=$zoom;	
}

}

?>