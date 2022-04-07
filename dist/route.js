var wayp = [];
var wph;
var wp1;
var wp2;
var wp3;
var wp4;

// fonction issue d'ici https://www.delftstack.com/fr/howto/javascript/permutations-in-javascript/
var permute = function(nums){
    var result = [];
    var backtrack = (i, nums) => {
      if(i===nums.length){
        result.push(nums.slice());
        return;
      }  
      for(let j = i; j < nums.length; j++){
        [nums[i],nums[j]] = [nums[j],nums[i]];
        backtrack(i+1, nums);
        [nums[i],nums[j]] = [nums[j],nums[i]];
      }
    }
    backtrack(0, nums);
    console.log(result);
    return result;
};
  
var shuffled;
var total_routes=[]
var promesse = [];
var leo;


function get_route(waypoints,i) {
    var defer = $.Deferred();
    var router = new L.routing.osrmv1({});
    router.route(waypoints, function (error, routes) {
        if (error== null) {
           console.log(routes[0]);
            total_routes.push(routes[0]);
            defer.resolve(i); 
        }
       
   });
    console.log("finito");
    //return routes[0];
    
  return defer.promise();
    
}

function find_optimum(total_routes) {
    var minimum = [];
    for (var i = 0; i < total_routes.length; i++) {
        console.log("temps total pour cette route");
        minimum[i]=total_routes[i].summary.totalTime;
        console.log(total_routes[i].summary.totalTime);
    }
    const min = Math.min.apply(null, minimum);
    const index = minimum.indexOf(min);
    console.log(index);
    return index;
}

function allroutes(shuffled) {
    //var defer = $.Deferred();
    for (var i = 0; i < shuffled.length/4; i++){
        console.log(shuffled[i]);
        promesse.push(Promise.resolve(get_route(shuffled[i],i)));  
    }
     Promise.all(promesse).then(function () {
        console.log("ECHEC ???");
         console.log(total_routes);
         var index_min = find_optimum(total_routes);
         console.log("index de la route optimale : ");
         console.log(total_routes[index_min]);
         var waypoints_optimal = total_routes[index_min].waypoints;
         draw(waypoints_optimal);
    });
}

function draw(waypo) {
    waypo.push(wph);
    waypo.unshift(wph);
    L.Routing.control({
        waypoints: waypo,
        routeWhileDragging: true,
    })
        .addTo(map);
    document.getElementById("attente").innerHTML = "";
}

function route(hlong, hlat, lat, long, lat2, long2, lat3, long3, lat4, long4) {
    wph =  L.Routing.waypoint(L.latLng(hlat, hlong));
    wp1= L.Routing.waypoint(L.latLng(lat, long));
    wp2= L.Routing.waypoint(L.latLng(lat2, long2));
    wp3= L.Routing.waypoint(L.latLng(lat3, long3));
    wp4= L.Routing.waypoint(L.latLng(lat4, long4));
    wayp = [wp1, wp2, wp3, wp4];
    shuffled = permute(wayp);
    allroutes(shuffled);
    //check(); 
}

function route3(hlong, hlat, lat, long, lat2, long2, lat3, long3) {
    wph =  L.Routing.waypoint(L.latLng(hlat, hlong));
    wp1= L.Routing.waypoint(L.latLng(lat, long));
    wp2= L.Routing.waypoint(L.latLng(lat2, long2));
    wp3= L.Routing.waypoint(L.latLng(lat3, long3));
    wayp = [wp1, wp2, wp3, wp4];
    shuffled = permute(wayp);
    allroutes(shuffled);
    //check(); 
}
function route2(hlong, hlat, lat, long, lat2, long2) {
    wph =  L.Routing.waypoint(L.latLng(hlat, hlong));
    wp1= L.Routing.waypoint(L.latLng(lat, long));
    wp2= L.Routing.waypoint(L.latLng(lat2, long2));
    wayp = [wp1, wp2, wp3, wp4];
    shuffled = permute(wayp);
    allroutes(shuffled);
    //check(); 
}

function route1(hlong, hlat, lat, long,) {
    wph =  L.Routing.waypoint(L.latLng(hlat, hlong));
    wp1= L.Routing.waypoint(L.latLng(lat, long));
    wayp = [wp1, wp2, wp3, wp4];
   // shuffled = permute(wayp);
    allroutes(wayp);
    //check(); 
}
    


//instance map
var map = L.map('map');

//fond de map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

//les waypoints 

var wp1 = [
     L.Routing.waypoint(L.latLng(45.7740068003761,4.8354739)),
     L.Routing.waypoint(L.latLng(45.7555720031532,4.81752260575356)),
     L.Routing.waypoint(L.latLng(45.7609617106543,4.82761522087057)),
     L.Routing.waypoint(L.latLng(45.7452482003801,4.8536107)),
   ];
var wp2 = [
     L.Routing.waypoint(L.latLng(45.7609617106543,4.82761522087057)),
     L.Routing.waypoint(L.latLng(45.7452482003801,4.8536107)),
    L.Routing.waypoint(L.latLng(45.7740068003761,4.8354739)),
     L.Routing.waypoint(L.latLng(45.7555720031532,4.81752260575356)),
   ];
var lesroutes=[];
var wp=[wp1,wp2];









//var wp=[]

var promesse=[];
/*for(var i=0; i<1; i++)
{
    promesse.push(Promise.resolve(get_route2(wp[i],i)));
}*/
//////////////////promesse.push(Promise.resolve(get_route2(wp1,0)));
//promesse.push(Promise.resolve(get_route2(wp2,1)));


/*Promise.all(promesse).then(function(){
    check();
})
*/
function check() {
    console.log("JE SUIS CHECKKKKKKK");
    wayp.push(wph);
    wayp.unshift(wph);
//alert("finiii");
   // alert("plus rapide");
    L.Routing.control({
        waypoints: wp1,
        routeWhileDragging: true,
    })
.addTo(map);



}



function get_route2(waypoints, i){
   var defer = $.Deferred();
   var router = new L.routing.osrmv1({});
   var router2 = new L.routing.osrmv1({});

   router.route(wp1, function(error, routes) {});
   router.route(wp2, function(error, routes) {});
   router.route(wp1, function(error, routes) {});
   router.route(wp2, function(error, routes) {});
   router.route(wp1, function(error, routes) {});
   router.route(wp2, function(error, routes) {});
   router.route(wp1, function(error, routes) {});
   router.route(wp2, function(error, routes) {});
   router.route(wp1, function(error, routes) {});
   router.route(wp2, function(error, routes) {});
   router.route(wp1, function(error, routes) {});
   router.route(wp2, function(error, routes) {});
 
  
   router2.route(wp2, function(error, routes) {
       defer.resolve(1);
   });
   console.log("finito");
   return defer.promise();
    

}


/*
var sort_cars2 = function(rutas) {
  var promise = new Promise(function(resolve,reject){
    rutas.sort(function(a, b){return a.summary.totalDistance-b.summary.totalDistance});
    resolve(rutas);
  });
  return promise;
}*/