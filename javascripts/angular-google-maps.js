/**!
 * The MIT License
 * 
 * Copyright (c) 2010-2012 Google, Inc. http://angularjs.org
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * angular-google-maps
 * https://github.com/nlaplante/angular-google-maps
 * 
 * @author Nicolas Laplante https://plus.google.com/108189012221374960701
 */

(function () {
  
  "use strict";
  
  /*
   * Utility functions
   */
  
  /**
   * Check if 2 floating point numbers are equal
   * 
   * @see http://stackoverflow.com/a/588014
   */
  function floatEqual (f1, f2) {
    return (Math.abs(f1 - f2) < 0.000001);
  }
  
  /* 
   * Create the model in a self-contained class where map-specific logic is 
   * done. This model will be used in the directive.
   */
  
  var MapModel = (function () {
    
    var _defaults = { 
        zoom: 8,
        draggable: false,
        container: null,
        maptype: null,
        maptypecontrol: false
      };
    /**
     * 
     */
    function PrivateMapModel(opts) {
      //console.log(_defaults);
      var _instance = null,
        _markers = [],  // caches the instances of google.maps.Marker
        _handlers = [], // event handlers
        _windows = [],  // InfoWindow objects
        o = angular.extend({}, _defaults, opts),
        that = this,
        currentInfoWindow = null;
     // console.log(opts)
     // console.log(opts);
      
      this.center = opts.center;
      this.zoom = o.zoom;
      this.draggable = o.draggable;
      this.dragging = false;
      this.selector = o.container;
      this.markers = [];
      this.maptype = o.maptype;
      this.mapTypeControl = o.mapTypeControl;
      this.panControl = o.panControl;
      this.zoomControl = o.zoomControl;
      this.overviewMapControl = o.overviewMapControl;
      this.streetViewControl = o.streetViewControl;
      this.scaleControl = o.scaleControl;
      this.scrollwheel = o.scrollwheel;
      this.mapheading = o.mapheading;
      
      this.draw = function () {
        
        if (that.center == null) {
          // TODO log error
          return;
        }
      //  console.log(that);
        //if (that.maptype == null) {
          // TODO log error
          //that.maptype = google.maps.MapTypeId.ROADMAP;
          //return;
       // }
        
        if (_instance == null) {
          
          // Create a new map instance
          
          _instance = new google.maps.Map(that.selector, {
            center: that.center,
            zoom: that.zoom,
            draggable: that.draggable,
            mapTypeControl: that.mapTypeControl,
            panControl: that.panControl,
            mapTypeId : that.maptype,
            zoomControl: that.zoomControl,
            scaleControl: that.scaleControl,
            streetViewControl: that.streetViewControl,
            overviewMapControl: that.overviewMapControl,
            scrollwheel: that.scrollwheel,
            mapheading: that.mapheading
          });
          
          google.maps.event.addListener(_instance, "dragstart",
              
              function () {
                that.dragging = true;
              }
          );
          
          google.maps.event.addListener(_instance, "idle",
              
              function () {
                that.dragging = false;
              }
          );
          
          google.maps.event.addListener(_instance, "drag",
              
              function () {
                that.dragging = true;   
              }
          );  
          
          google.maps.event.addListener(_instance, "zoom_changed",
              
              function () {
                that.zoom = _instance.getZoom();
                that.center = _instance.getCenter();
                if(_instance.getTilt())
                    $('#map_heading_rotate').show();
                else
                    $('#map_heading_rotate').hide();
              }
          );
          
          google.maps.event.addListener(_instance, "center_changed",
              
              function () {
                that.center = _instance.getCenter();
              }
          );
          
          // Attach additional event listeners if needed
          if (_handlers.length) {
            
            angular.forEach(_handlers, function (h, i) {
              
              google.maps.event.addListener(_instance, 
                  h.on, h.handler);
            });
          }
        }
        else {
          
          // Refresh the existing instance
          google.maps.event.trigger(_instance, "resize");
          
          var instanceCenter = _instance.getCenter();
          
          if (!floatEqual(instanceCenter.lat(), that.center.lat())
            || !floatEqual(instanceCenter.lng(), that.center.lng())) {
              _instance.setCenter(that.center);
          }
        
          if (_instance.getZoom() != that.zoom) {
            _instance.setZoom(that.zoom);
          }          
        }
      };
      
      this.fit = function () {
        if (_instance && _markers.length) {
          
          var bounds = new google.maps.LatLngBounds();
          
          angular.forEach(_markers, function (m, i) {
            bounds.extend(m.getPosition());
          });
          
          _instance.fitBounds(bounds);
        }
      };
      
      this.calDest = function(lat1, lon1, brng, d) {
            var R = 6371 * 1000;
            brng = de2ra(brng);
            lat1 = de2ra(lat1);
            lon1 = de2ra(lon1);
            var lat2 = Math.asin(Math.sin(lat1) * Math.cos(d / R) + Math.cos(lat1) * Math.sin(d / R) * Math.cos(brng));
            var lon2 = lon1 + Math.atan2(Math.sin(brng) * Math.sin(d / R) * Math.cos(lat1),
            Math.cos(d / R) - Math.sin(lat1) * Math.sin(lat2));
            lon2 = (lon2 + 3 * Math.PI) % (2 * Math.PI) - Math.PI;
            return new google.maps.LatLng(ra2de(lat2), ra2de(lon2));
        }
      
      this.pan = function (latlng) {
        if (_instance ) {
           _instance.panTo(latlng);
        }
      };
      
      this.on = function(event, handler) {
        _handlers.push({
          "on": event,
          "handler": handler
        });
      };
      
      
       this.drawCircle = function(position, color, size) {
            var circlePath = [];
            var initBrng = 0;
            for (var i = 0; i < 120; i++) {
                circlePath.push(calDest(position.lat(), position.lng(), initBrng, size));
                initBrng += 5;
            }
            var circle = new google.maps.Polygon({
                path: circlePath,
                strokeColor: color,
                strokeOpacity: 0.1,
                strokeWeight: 4,
                fillColor: color,
                fillOpacity: 0.3
            });
            circle.setMap(_instance);
        }
      
      this.drawShots = function (startShot, endShot, map, pathcolor, key) {
        // map = _instance;
       
        var startlatlon = new google.maps.LatLng(startShot.latitude, startShot.longitude);
        var d = (isNumber(startShot.calculated_distance_metres) ? parseFloat(startShot.calculated_distance_metres) : calDistance(startShot.latitude, startShot.longitude, endShot.latitude, endShot.longitude));
        var r = d;
        if (d > 150) r = d / 2 + 200;
        var ppath = [];
        ppath.push(new google.maps.LatLng(startShot.latitude, startShot.longitude));
        if (d > 5) {
        var brng = calBearing(startShot.latitude, startShot.longitude, endShot.latitude, endShot.longitude);
        var ang = calAngel(r, d);
        var dang = (brng + 270 + ang / 2) % 360;
        //if(brng < 180 && brng >=0)
            //      dang = 360 - dang;
            var rp = calDest(startShot.latitude, startShot.longitude, dang, r);
            var pdang = (dang + 180) % 360;
            var qdang = pdang - ang;
            if (pdang - qdang < 0) qdang = qdang - 360;
            //if(brng > 180 && brng <=360)
            //      pdang =  360 - pdang;
            //ppath.push(rp);
            while (pdang - qdang > 1) {
                pdang = pdang - 1 / _instance.getZoom() - 1;
                var endlocation = calDest(rp.lat(), rp.lng(), pdang, r);
                ppath.push(endlocation);
                //drawsegment(startlatlon, endlocation, pathcolor, startShot, key);
                var startlatlon = endlocation;
            }
        }
        
        
    
        var endLatlng = new google.maps.LatLng(endShot.latitude, endShot.longitude);
        ppath.push(endLatlng);
        var shotPath = new google.maps.Polygon({
            path: ppath,
            strokeColor: pathcolor,
            strokeOpacity: 0.1,
            strokeWeight: 4,
            fillColor: pathcolor,
            fillOpacity: 0.2
        });
        shotPath.setMap(_instance);
        var holepath = new google.maps.Polyline({
            holeid: key,
            shotinfo: startShot,
            originalcolor: pathcolor,
            path: ppath,
            strokeColor: pathcolor,
            strokeOpacity: 0.7,
            strokeWeight: 3
        });        
        var holepath = new google.maps.Polyline({
            holeid: key,
            shotinfo: startShot,
            originalcolor: pathcolor,
            path: ppath,
            strokeColor: pathcolor,
            strokeOpacity: 0.7,
            strokeWeight: 3
        });

        holepath.setMap(_instance);
        this.drawCircle(endLatlng, pathcolor, _instance.getZoom() / 5);

          
      }
      
      this.setmapheading = function(newheading)
      {
         if (_instance.getTilt())
         {
             _instance.setHeading(newheading)
         }
      }
      
      this.addMarker = function (lat, lng, icon, infoWindowContent, label, url,
          thumbnail) {
        
        if (that.findMarker(lat, lng) != null) {
          return;
        }
        
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(lat, lng),
          map: _instance,
          icon: icon
        });
        
        if (label) {
          
        }
        
        if (url) {
          
        }

        if (infoWindowContent != null) {
          var infoWindow = new google.maps.InfoWindow({
            content: infoWindowContent
          });

          google.maps.event.addListener(marker, 'click', function() {
            if (currentInfoWindow != null) {
              currentInfoWindow.close();
            }
            infoWindow.open(_instance, marker);
            currentInfoWindow = infoWindow;
          });
        }
        
        // Cache marker 
        _markers.unshift(marker);
        
        // Cache instance of our marker for scope purposes
        that.markers.unshift({
          "lat": lat,
          "lng": lng,
          "draggable": false,
          "icon": icon,
          "infoWindowContent": infoWindowContent,
          "label": label,
          "url": url,
          "thumbnail": thumbnail
        });
        
        // Return marker instance
        return marker;
      };      
      
      this.findMarker = function (lat, lng) {
        for (var i = 0; i < _markers.length; i++) {
          var pos = _markers[i].getPosition();
          
          if (floatEqual(pos.lat(), lat) && floatEqual(pos.lng(), lng)) {
            return _markers[i];
          }
        }
        
        return null;
      };  
      
      this.findMarkerIndex = function (lat, lng) {
        for (var i = 0; i < _markers.length; i++) {
          var pos = _markers[i].getPosition();
          
          if (floatEqual(pos.lat(), lat) && floatEqual(pos.lng(), lng)) {
            return i;
          }
        }
        
        return -1;
      };
      
      this.addInfoWindow = function (lat, lng, html) {
        var win = new google.maps.InfoWindow({
          content: html,
          position: new google.maps.LatLng(lat, lng)
        });
        
        _windows.push(win);
        
        return win;
      };
      
      this.hasMarker = function (lat, lng) {
        return that.findMarker(lat, lng) !== null;
      };  
      
      this.getMarkerInstances = function () {
        return _markers;
      };
      
      this.removeMarkers = function (markerInstances) {
        
        var s = this;
        
        angular.forEach(markerInstances, function (v, i) {
          var pos = v.getPosition(),
            lat = pos.lat(),
            lng = pos.lng(),
            index = s.findMarkerIndex(lat, lng);
          
          // Remove from local arrays
          _markers.splice(index, 1);
          s.markers.splice(index, 1);
          
          // Remove from map
          v.setMap(null);
        });
      };
    }
    
    // Done
    return PrivateMapModel;
  }());
  
  // End model
  
  // Start Angular directive
  
  var googleMapsModule = angular.module("google-maps", []);

  /**
   * Map directive
   */
  googleMapsModule.directive("googleMap", ["$log", "$timeout", "$filter", function ($log, $timeout, 
      $filter) {

    var controller = function ($scope, $element) {
      
      var _m = $scope.map;
      
      self.addInfoWindow = function (lat, lng, content) {
        _m.addInfoWindow(lat, lng, content);
      };
    };

    controller.$inject = ['$scope', '$element'];
    
    return {
      restrict: "EC",
      priority: 100,
      transclude: true,
      template: "<div class='angular-google-map' ng-transclude></div>",
      replace: false,
      scope: {
        center: "=center", // required
        markers: "=markers", // optional
        latitude: "=latitude", // required
        longitude: "=longitude", // required
        zoom: "=zoom", // required
        mapheading: "=mapheading", // required
        refresh: "&refresh", // optional
        windows: "=windows", // optional"
        maptype: "=maptype", // optional"
      },
      controller: controller,      
      link: function (scope, element, attrs, ctrl) {
        
        // Center property must be specified and provide lat & 
        // lng properties
        if (!angular.isDefined(scope.center) || 
            (!angular.isDefined(scope.center.lat) || 
                !angular.isDefined(scope.center.lng))) {
        	
          $log.error("angular-google-maps: could not find a valid center property");          
          return;
        }
        
        if (!angular.isDefined(scope.zoom)) {
        	$log.error("angular-google-maps: map zoom property not set");
        	return;
        }
        
        if (!angular.isDefined(attrs.mapTypeControl)) 
        	scope.mapTypeControl = false;
        else
	        scope.mapTypeControl = true;
	        
	    if (!angular.isDefined(attrs.panControl)) 
        	scope.panControl = false;
        else
	        scope.panControl = true;
	    
	    if (!angular.isDefined(attrs.zoomControl)) 
        	scope.zoomControl = false;
        else
	        scope.zoomControl = true;
	    
	    if (!angular.isDefined(attrs.overviewMapControl)) 
        	scope.overviewMapControl = false;
        else
	        scope.overviewMapControl = true;
	    
	    if (!angular.isDefined(attrs.streetViewControl)) 
        	scope.streetViewControl = false;
        else
	        scope.streetViewControl = true;
	    
	    if (!angular.isDefined(attrs.scaleControl)) 
        	scope.scaleControl = false;
        else
	        scope.scaleControl = true;
	        
	    if (!angular.isDefined(attrs.scrollwheel)) 
        	scope.scrollwheel = false;
        else
	        scope.scrollwheel = true;
      
  
        
        if (!angular.isDefined(attrs.maptype)) {
        	scope.maptype = google.maps.MapTypeId.ROADMAP; //default
        }
        else
        {
           attrs.maptype = angular.uppercase(attrs.maptype);
           switch(attrs.maptype)
	       {
		   	case "ROADMAP":
		   		scope.maptype = google.maps.MapTypeId.ROADMAP;
		   		break;	
		   	case "HYBRID":
		   		scope.maptype = google.maps.MapTypeId.HYBRID;
		   		break;
		   	case "SATELLITE":
		   	    scope.maptype = google.maps.MapTypeId.SATELLITE;
		   		break;
		   	case "TERRAIN":
		   	    scope.maptype = google.maps.MapTypeId.TERRAIN;
		   		break;  
		   	default: 
		   		scope.maptype = google.maps.MapTypeId.ROADMAP;
	       }
	    }
        
        //console.log(scope);
       
        angular.element(element).addClass("angular-google-map");
        
        // Create our model
        var _m = new MapModel({
          container: element[0],            
          center: new google.maps.LatLng(scope.center.lat, scope.center.lng),              
          draggable: attrs.draggable == "true",
          zoom: scope.zoom,
          maptype: scope.maptype,
          mapTypeControl: scope.mapTypeControl,
          scaleControl: scope.scaleControl,
          overviewMapControl: scope.overviewMapControl,
          streetViewControl: scope.streetViewControl,
          zoomControl: scope.zoomControl,
          panControl: scope.panControl,
          scrollwheel: scope.scrollwheel
        });       
        //console.log(_m);
        
        _m.on("drag", function () {
          
          var c = _m.center;
        
          $timeout(function () {
            
            scope.$apply(function (s) {
              scope.center.lat = c.lat();
              scope.center.lng = c.lng();
            });
          });
        });
      
        _m.on("zoom_changed", function () {
          
          if (scope.zoom != _m.zoom) {
            
            $timeout(function () {
              
              scope.$apply(function (s) {
                scope.zoom = _m.zoom;
              });
            });
          }
        });
      
        _m.on("center_changed", function () {
          var c = _m.center;
        
          $timeout(function () {
            
            scope.$apply(function (s) {
              
              if (!_m.dragging) {
                scope.center.lat = c.lat();
                scope.center.lng = c.lng();
              }
            });
          });
        });
        
        if (attrs.markClick == "true") {
          (function () {
            var cm = null;
            
            _m.on("click", function (e) {                         
              if (cm == null) {
                
                cm = {
                  latitude: e.latLng.lat(),
                  longitude: e.latLng.lng() 
                };
                
                scope.markers.push(cm);
              }
              else {
                cm.latitude = e.latLng.lat();
                cm.longitude = e.latLng.lng();
              }
              
              $timeout(function () {
                scope.$apply();
              });
            });
          }());
        }
        
        // Put the map into the scope
        scope.map = _m;
        
        // Check if we need to refresh the map
        if (angular.isUndefined(scope.refresh())) {
          // No refresh property given; draw the map immediately
          _m.draw();
        }
        else {
          scope.$watch("refresh()", function (newValue, oldValue) {
            if (newValue && !oldValue) {
              _m.draw();
            }
          }); 
        }
        
        
        
        // Markers
        scope.$watch("markers", function (newValue, oldValue) {
          
          $timeout(function () {
            
            angular.forEach(newValue, function (v, i) {
                if (!_m.hasMarker(v.latitude, v.longitude)) {
                    _m.addMarker(v.latitude, v.longitude, v.icon, v.infoWindow);
                }
               var startlatlon = null;
              var startlat = null;
              var startlon = null; 
               for(var index=0; index< v.shots.length; index++) {
                    
                    var pathcolor = '#0f0';
                    if (index == v.hole_par)
                    {
                        pathcolor = '#FFFF00';
                    }
                    else if (index > v.hole_par)
                    {
                        pathcolor = '#FF0000';
                    }
                    //console.log(v.shots[index]);
                    if(typeof v.shots[index+1] === "undefined")
                    {
                    
                        var nextshot = {
                          latitude: v.last_latitude,
                          longitude: v.last_longitude
                        }
                    }
                    else
                    {
                        var nextshot = v.shots[index+1];
                    }
                    _m.drawShots(v.shots[index], nextshot, _m, pathcolor, i); 
                    
                    //_m.drawShots(v.shots[index], index < v.shots[index].length - 1 ? v.shots[index+1] 
                      //   : {'latitude': v.latitude, 'longitude':v.longitude}, _m, pathcolor, i);   
               }
        
            });
            
            // Clear orphaned markers
            var orphaned = [];
            
            angular.forEach(_m.getMarkerInstances(), function (v, i) {
              // Check our scope if a marker with equal latitude and longitude. 
              // If not found, then that marker has been removed form the scope.
              
              var pos = v.getPosition(),
                lat = pos.lat(),
                lng = pos.lng(),
                found = false;
              
              // Test against each marker in the scope
              for (var si = 0; si < scope.markers.length; si++) {
                
                var sm = scope.markers[si];
                
                if (floatEqual(sm.latitude, lat) && floatEqual(sm.longitude, lng)) {
                  // Map marker is present in scope too, don't remove
                  found = true;
                }
              }
              
              // Marker in map has not been found in scope. Remove.
              if (!found) {
                orphaned.push(v);
              }
            });

            orphaned.length && _m.removeMarkers(orphaned);           
            
            // Fit map when there are more than one marker. 
            // This will change the map center coordinates
            if (attrs.fit == "true" && newValue.length > 1) {
              _m.fit();
            }
          });
          
        }, true);
        
        
        // Update map when center coordinates change
        scope.$watch("center", function (newValue, oldValue) {
          if (newValue === oldValue) {
            return;
          }
          
          if (_m.dragging) {
            _m.center = new google.maps.LatLng(newValue.lat, 
                newValue.lng);          
            _m.draw();
          }
          else
          {
            _m.pan(new google.maps.LatLng(newValue.lat, 
                newValue.lng));
            
          }
        }, true);
        
        scope.$watch("zoom", function (newValue, oldValue) {
          if (newValue === oldValue) {
            return;
          }
          
          _m.zoom = newValue;
          _m.draw();
        });
        
        scope.$watch("mapheading", function (newValue, oldValue) {
          if (newValue === oldValue) {
            return;
          }
          
          _m.mapheading = newValue;
          _m.setmapheading(newValue);
        });
        
        scope.$watch("maptype", function (newValue, oldValue) {
         // console.log(oldValue);
         // console.log(newValue);
          if (newValue === oldValue) {
            return;
          }
          _m.maptype = newValue;
          _m.draw();
        });
        
      
        
      }
    };
  }]);  
}());
