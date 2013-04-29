/*--- APP ---*/ 
var app = angular.module('touro', ['ngResource','ui.bootstrap', 'ui']).
  config(['$routeProvider','$locationProvider', function($routeProvider, $locationProvider) {
    
}]);


app.factory('touroSearchService', function($q, $http,$resource,$rootScope) {
  //$http.defaults.useXDomain = true;
  this.searchdata = false;
  this.searchparams = false;
  this.searchType = '';
  
  var resource = $resource('/searchp.php',
	    { },
	    { 
	    	getSearch: { method: "GET", params: { default_operator: "AND"}}
	    }
	);
	
  var getSearch = function(data) { 
    //console.log(data);
    var dfd = $q.defer();
    resource.getSearch(data, function (result) {
      dfd.resolve(result);
    } ,  function (r) {
      dfd.resolve(false);
    });
    
  	return dfd.promise;
  };
  var clearsearch = function() {
     this.searchdata = false;
     $rootScope.$broadcast('clearsearch'+this.searchType);
     return this.searchdata;
  };
	var setsearchdata = function(data) {
	  if(data.data.hits.total) //check for good search
    {
      this.searchdata = data;
      console.log('updatesearch'+this.searchType);
      $rootScope.$broadcast('updatesearch'+this.searchType);
      return this.searchdata;
    }
    else
    {
      return false;
    }
  };
   var doSearch = function(data, stype) {
     this.searchparams = data;
     this.searchType = stype;
     $rootScope.$broadcast('doasearch'+this.searchType);
     return true;
  };
  var getsearchparams = function(){
    return this.searchparams;
  }

    return {
        getSearch: function(data) {

        	return getSearch(data); 
        },
        setSearchData: function(data) {
          return setsearchdata(data);
        },
        getSearchdata: function() {
          
          return searchdata;
        },
        clearSearch: function() {
          return clearsearch();
        },
        doSearch: function(data, stype) {
          return doSearch(data,stype);
        },
        getSearchParams: function () {
          return getsearchparams();
        },
        getSearchType: function () {
          return getsearchtype();
        }
    };
});















app.filter('swapurl', function(){
	return function(text, source_url){
		return source_url ? source_url : text;
	} 
});

app.filter('newlines', function () {
  return function(text){
    return text.replace(/\n/g, '<br/>');
  }
});

app.filter('removenewlines', function () {
  return function(text){ 
    text = text.replace(/\\n/g, '');
    text = text.replace(/\n/g, '');
    return text;
  }
});

app.directive('touroSearch', function($timeout, $rootScope, touroSearchService){
   return {
      restrict: 'EA',
      replace: true,
      transclude: true,
      scope: { 
       searchElementUniqueid: "@searchElementUniqueid",
       searchCollection: "@searchCollection"
      },
      template: '<div class="search-form {{searchCollection}}"><input id="{{searchElementUniqueid}}" class="searchinput" type="text" name="search"/></div>',
      link: function(scope, elem, attr) {
        var hideonsearch = $(attr.replaceDiv);
        var searchsize = attr.searchSize;
        if(!angular.isDefined(attr.searchCollection))
          attr.searchCollection = 'all';
        var timeout = false;
        var thisinput = $($(elem).find('.searchinput')[0]);
        thisinput.attr('id', attr.searchElementUniqueid);
        thisinput.attr('placeholder', attr.placeHolderText);
        thisinput.addClass(attr.inputClass);
        thisinput.on('keyup', function () { 
     
           $(this).val($(this).val().replace(/[^ a-zA-Z0-9-]/g, ''));
           var searchedterm = $.trim($(this).val());
           $('.searcherror').each(function (v, i) { $(i).remove(); });
           timeout = $timeout( function () { 
             if(searchedterm != '') {
               touroSearchService.doSearch({ q: searchedterm, collection: attr.searchCollection,  size: searchsize, default_operator: 'AND', hidedoms: hideonsearch, searchinput: attr.searchElementUniqueid}, attr.searchElementUniqueid);   

             }
             else {
               touroSearchService.clearSearch();
               hideonsearch.each(function () { 
                $(this).slideDown('fast');
               }); 
               $('.searcherror').each(function (v, i) { $(i).remove(); });
             }
           }, 500);
        

        
        });
        thisinput.on('focus', function () { 
            if(thisinput.val() == attr.placeHolderText)
              thisinput.val('');

        });
        thisinput.on('blur', function () { 
            if(thisinput.val() == '') {
              $rootScope.$broadcast('clearsearch'+$scope.uniquesearchid);
              thisinput.val(attr.placeHolderText);  
              $('#'+attr.searchElementUniqueid).removeClass('main-search-field-error');  
            }

        });

        thisinput.on('keydown', function () { 
             $timeout.cancel(timeout);
             $('.searcherror').each(function (v, i) { $(i).remove(); });

        });
     }
   };
});



function SearchCtrl($scope, $rootScope, touroSearchService) {
  $scope.currentPage = 0;
  $scope.noOfPages = 0;
  $scope.maxSize = 5;
  $scope.searchSize = 0;
  $scope.searchedParams = false;
  $scope.uniquesearchid = 'mainsearch';
  $scope.doSearch = function(page) {

    $('#'+$scope.searchedParams.searchinput).removeClass('main-search-field-error');  
    if(page > 0)
      var startfrom = $scope.searchedParams.size * (page-1);
      
    var searched = touroSearchService.getSearch({ from: startfrom, q: $scope.searchedParams.q, collection: $scope.searchedParams.collection,  size: $scope.searchedParams.size});
      searched.then(function (result) { 
        
        if(typeof _gaq != 'undefined') {
          _gaq.push(['_trackEvent', 'Search', 'GoodSearch', $scope.searchedParams.q]); //custom event tracking
        }
        if(getJSONCount(result.hits.hits)!= 0) {
          $scope.searchedParams.hidedoms.each(function () { 
            $(this).hide(); 
            }); 
            $scope.searchedData = {  page: page, searched: $scope.searchedParams.q,  size: $scope.searchedParams.size, data: result};
            $scope.currentPage = $scope.searchedData.page;
            $scope.searchSize = result.hits.total;
            $scope.noOfPages  = Math.ceil(result.hits.total/$scope.searchedData.size);
        }
        else
        {
          
            if(typeof _gaq != 'undefined') {
              _gaq.push(['_trackEvent', 'Search', 'BadSearch', $scope.searchedParams.q]); //custom event tracking
            }
            $('#'+$scope.searchedParams.searchinput).addClass('main-search-field-error');  
            $scope.searchedData = false;
            $scope.searchedParams.hidedoms.each(function () { 
              $(this).show(); 
            });  
        }
        
      }, 
      function (failedresult) {
        if(typeof _gaq != 'undefined') {
            _gaq.push(['_trackEvent', 'Search', 'BadSearch', $scope.searchedParams.q]); //custom event tracking
          }
          $('#'+$scope.searchedParams.searchinput).addClass('main-search-field-error');  
         $scope.searchedData = false;
         $scope.searchedParams.hidedoms.each(function () { 
          $(this).show(); 
         });  
      });
      
  }
  
  $scope.$on('doasearch'+$scope.uniquesearchid, function () {
    $scope.searchedParams = touroSearchService.getSearchParams();
    $scope.doSearch(1);
  }); 
  
   
  $scope.$watch('currentPage', function () {
    // $scope.getwineries($scope.currentPage);
    if($scope.searchedParams != false && $scope.currentPage != 0) {
     $scope.doSearch($scope.currentPage);
    }
    else
    {
      $scope.searchedData = false;
    }
    $('html, body').animate({
        scrollTop: $('.brand').offset().top
      }, 500);
  }); 
  
  $scope.searchedData = false;
  
  $scope.$on('updatesearch'+$scope.uniquesearchid, function() {
    $scope.searchedData = touroSearchService.getSearchdata();
    $scope.currentPage = $scope.searchedData.page;
    $scope.searchSize = $scope.searchedData.size;
    $scope.noOfPages  = Math.ceil($scope.searchedData.data.hits.total/$scope.searchedData.size); 
    //$scope.$$phase || $scope.$apply();
  });
  
  $scope.$on('clearsearch'+$scope.uniquesearchid, function() {
    $scope.searchedData = false;
    $scope.$$phase || $scope.$apply();
  });
  
}



function SecondarySearchCtrl($scope, $rootScope, touroSearchService) {
  $scope.currentPage = 0;
  $scope.noOfPages = 0;
  $scope.maxSize = 5;
  $scope.searchSize = 0;
  $scope.searchedParams = false;
  $scope.uniquesearchid = 'subsearch';
  $scope.doSearch = function(page) {
     
    $('#'+$scope.searchedParams.searchinput).removeClass('main-search-field-error');  
    if(page > 0)
      var startfrom = $scope.searchedParams.size * (page-1);
      
    var searched = touroSearchService.getSearch({ from: startfrom, q: $scope.searchedParams.q, collection: $scope.searchedParams.collection, size: $scope.searchedParams.size});
      searched.then(function (result) { 
        
        if(typeof _gaq != 'undefined') {
          _gaq.push(['_trackEvent', 'Search', 'GoodSearch', $scope.searchedParams.q]); //custom event tracking
        }
        if(getJSONCount(result.hits.hits)!= 0) {
          $scope.searchedParams.hidedoms.each(function () { 
            $(this).hide(); 
            }); 
            $scope.searchedSubData = {  page: page, searched: $scope.searchedParams.q, size: $scope.searchedParams.size, data: result};
            $scope.currentPage = $scope.searchedSubData.page;
            $scope.searchSize = result.hits.total;
            $scope.noOfPages  = Math.ceil(result.hits.total/$scope.searchedSubData.size);
        }
        else
        {
          
            if(typeof _gaq != 'undefined') {
              _gaq.push(['_trackEvent', 'Search', 'BadSearch', $scope.searchedParams.q]); //custom event tracking
            }
            $('#'+$scope.searchedParams.searchinput).addClass('main-search-field-error');  
            $scope.searchedSubData = false;
            $scope.searchedParams.hidedoms.each(function () { 
              $(this).show(); 
            });  
        }
        
      }, 
      function (failedresult) {
        if(typeof _gaq != 'undefined') {
            _gaq.push(['_trackEvent', 'Search', 'BadSearch', $scope.searchedParams.q]); //custom event tracking
          }
          $('#'+$scope.searchedParams.searchinput).addClass('main-search-field-error');  
         $scope.searchedSubData = false;
         $scope.searchedParams.hidedoms.each(function () { 
          $(this).show(); 
         });  
      });
      
  }
  
  $scope.$on('doasearch'+$scope.uniquesearchid, function () {
    $scope.searchedParams = touroSearchService.getSearchParams();
    $scope.doSearch(1);
  }); 
  
   
  $scope.$watch('currentPage', function () {
    // $scope.getwineries($scope.currentPage);
    if($scope.searchedParams != false && $scope.currentPage != 0) {
     $scope.doSearch($scope.currentPage);
    }
    else
    {
      $scope.searchedSubData = false;
    }
    $('html, body').animate({
        scrollTop: $('.brand').offset().top
      }, 500);
  }); 
  
  $scope.searchedSubData = false;
  
  $scope.$on('updatesearch'+$scope.uniquesearchid, function() {
    alert('test');
    $scope.searchedSubData = touroSearchService.getSearchdata();
    $scope.currentPage = $scope.searchedSubData.page;
    $scope.searchSize = $scope.searchedSubData.size;
    $scope.noOfPages  = Math.ceil($scope.searchedSubData.data.hits.total/$scope.searchedSubData.size); 
    //$scope.$$phase || $scope.$apply();
  });
  
  $scope.$on('clearsearch'+$scope.uniquesearchid, function() {
    $scope.searchedSubData = false;
    $scope.$$phase || $scope.$apply();
  });
  
}



function CalendarCtrl($scope) {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();
   
  $scope.eventSource = {
    url: "http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic",
    className: 'gcal-event', // an option!
    currentTimezone: 'America/Chicago' // an option!
  };
   
  $scope.events = [
    {title: 'All Day Event',start: new Date(y, m, 1)},
    {title: 'Long Event',start: new Date(y, m, d - 5),end: new Date(y, m, d - 2)},
    {id: 999,title: 'Repeating Event',start: new Date(y, m, d - 3, 16, 0),allDay: false},
    {id: 999,title: 'Repeating Event',start: new Date(y, m, d + 4, 16, 0),allDay: false},
    {title: 'Birthday Party',start: new Date(y, m, d + 1, 19, 0),end: new Date(y, m, d + 1, 22, 30),allDay: false},
    {title: 'Click for Google',start: new Date(y, m, 28),end: new Date(y, m, 29),url: 'http://google.com/'}
  ];
   
  $scope.eventSources = [$scope.events, $scope.eventSource];
   
  $scope.addEvent = function() {
    $scope.events.push({
    title: 'Open Sesame',
    start: new Date(y, m, 28),
    end: new Date(y, m, 29)
    });
  }
   
  $scope.remove = function(index) {
    $scope.events.splice(index,1);
  }
}



var getJSONCount = function(json) {
  
  var count = 0;
  for(var dummy in json) count++;
  return count;
}
