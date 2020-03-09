//Initialisation des coordonnées de la map. Ici, au dessus de Paris
var map = L.map( 'map', {
    center: [48.8662, 2.3124],
    minZoom: 2,
    zoom: 4
});


//Chargement des tuiles
// Consulter cette page pour la liste des serveurs : http://wiki.openstreetmap.org/wiki/Slippy_map_tilenames#Tile_servers
//
//mapquest : http://{s}.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.png
//OSM : http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png

L.tileLayer( '//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="http://osm.org/copyright" title="OpenStreetMap" target="_blank">OpenStreetMap</a> contributors | @Nolisa</a>',
    subdomains: ['a','b','c']
}).addTo( map );


//Gestion des popups. On boucle sur les données contenues dans le fichier json
for ( var i=0; i < markers.length; ++i )
{


	var StatIcon = L.icon({
	    iconUrl: 'images/marker-' + markers[i].host_status + '.png',

	    iconSize:     [25,41] // size of the icon
	    //shadowSize:   [50, 64], // size of the shadow
	    //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
	    //shadowAnchor: [4, 62],  // the same for the shadow
	    //popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
	});

   L.marker([markers[i].latitude, markers[i].longitude],
   {
        icon: StatIcon
   })
      //.bindPopup('<b>' + markers[i].ip + '</b>')
      .bindPopup('<img src="images/host-black.png" width="32"><img src="images/' + markers[i].host_status + '.png" width="32"><img src="images/' + markers[i].os + '.png" width="32"><br>Host: <a href="index.php?topics=monhost&host_mon=' + markers[i].ip + '"><b>' + markers[i].ip + '</a></b><br>FQDN: <b>' + markers[i].fqdn + '</b><br>Location: <i>' + markers[i].country + ' (' + markers[i].timezone + '</i>)<br>Org: <b>' + markers[i].organization + '</b><br><i>' + markers[i].date + '</i><br><i>Status: ' + markers[i].host_status + '</i><br><i>sshd status: ' + markers[i].sshd_status + '</i>')
      .addTo( map );
}
