var urlCommon = '/common/default';

myAngular.factory('httpGetSection', function ($http, $q) {    
    return {
        getData: function (baseURL) {
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-section').then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) {                    
                    console.log(response.data.message);
                });
            return deferred.promise;
        }
    };
});
myAngular.factory('httpGetLevel', function($http, $q) {
    return{
        getData : function(baseURL){
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-level').then(
                 function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                }
            );
            return deferred.promise;
        }
    };
});
myAngular.factory('httpGetPeriod', function ($http, $q) {    
    return {
        getData: function (baseURL, m = '', y = '') {
            var deferred = $q.defer();
            var params = 'm=' + m + '&y=' + y;
            $http.get(baseURL + urlCommon + '/get-period?' + params).then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        }
    };
});

myAngular.factory('httpGetRank', function ($http, $q) {    
    return {
        getData: function (baseURL) {
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-rank').then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        }
    };
});

myAngular.factory('httpGetType', function ($http, $q) {    
    return {
        getData: function (baseURL) {
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-type').then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        }
    };
});

myAngular.factory('httpGetEnum', function ($http, $q) {    
    return {
        getProjectStatus: function (baseURL) {
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-enum-define?id=1').then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        },
        getOTStatus: function (baseURL) {
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-enum-define?id=2').then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        },
        getPeriodStatus: function (baseURL) {
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-enum-define?id=3').then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        }
    };
});

myAngular.factory('httpGetProjectGroup', function ($http, $q) {    
    return {
        getData: function (baseURL) {
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-project-group').then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        }
    };
});

myAngular.factory('httpGetProject', function ($http, $q) {    
    return {
        getData: function (baseURL) {
            var deferred = $q.defer();
            $http.get(baseURL + urlCommon + '/get-project').then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        }
    };
});

myAngular.factory('httpGetEmployee', function ($http, $q) {    
    return {
        getData: function (baseURL, section = '') {
            var useUrl = baseURL + urlCommon + '/get-employee';
            var deferred = $q.defer();
            $http.get(useUrl + (section === '' ? '' : '?s='+section)).then(
                function (response) {
                    deferred.resolve(response.data);
                }, function (response) { 
                    console.log(response.data.message);
                });
            return deferred.promise;
        }
    };
});