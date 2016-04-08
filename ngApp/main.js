(function () {
    'use strict';
    angular.module('SymfonyApp', ['ngRoute', 'ngAnimate', 'SymfonyAppTpl', 'restangular', 'ui.bootstrap'])
        .service('authorisation', ['$window', function($window) {

            var storage = $window.localStorage;
            var cachedToken;
            var userToken = 'userToken';

            var authorisation = {
                setToken: function(token) {
                    cachedToken = token;
                    storage.setItem(userToken, token);
                },

                getToken: function() {
                    if (!cachedToken) {
                        cachedToken = storage.getItem(userToken);
                    }
                    return cachedToken;
                },

                isAuthenticated: function() {
                    // return true;
                    return !!authorisation.getToken();
                },
                removeToken: function() {
                    cachedToken = null;
                    storage.removeItem(userToken);
                }
            };

            return authorisation;

        }])
        .run([
            'Restangular',
            'authorisation',
            function(RestangularProvider, authorisation) {
                if (authorisation.is) {
                    RestangularProvider.setDefaultHeaders({Authorization: 'Bearer ' + authorisation.getToken()})
                }
            }
        ])
        .config([
            '$locationProvider',
            '$routeProvider',
            '$interpolateProvider',
            'RestangularProvider',
            function($locationProvider, $routeProvider, $interpolateProvider, RestangularProvider) {
                // $locationProvider.hashPrefix('!');
                $interpolateProvider.startSymbol('[[').endSymbol(']]');
                // routes
                $routeProvider
                    .when("/", {
                        templateUrl: "article_list.html",
                        controller: "PageController"
                    })
                    .when("/article/:articleId", {
                        templateUrl: "article.html",
                        controller: "ArticleController",
                        resolve: {
                            article: ArticleController.loadArticle
                        }
                    })
                    .otherwise({
                        redirectTo: '/'
                    });
                RestangularProvider.setBaseUrl('http://localhost:8000/api/v1');
            }
        ]);

    //Load controller
    var app = angular.module('SymfonyApp');
    var MainController = app.controller('MainController', [
            '$scope',
            '$rootScope',
            '$location',
            'Restangular',
            '$uibModal',
            'authorisation',
        '$route',
            function($scope, $rootScope, $location, Restangular, $uibModal, authorisation, $route) {
                $rootScope.authenticated = authorisation.isAuthenticated();
                $scope.newArticle = function () {
                    var modalInstance = $uibModal.open({
                        templateUrl: 'createArticle.html',
                        animation: true,
                        size: 'lg',
                        backdrop: 'static',
                        controller: ['$scope', '$uibModalInstance', function ($scope, $uibModalInstance) {
                            $scope.submitArticle = function () {
                                $uibModalInstance.close($scope.article);
                            };
                            $scope.cancel = function () {
                                $uibModalInstance.dismiss('cancel');
                            };
                        }]
                    });
                    modalInstance.result.then(function (article) {
                        Restangular.all('articles').post(article);
                        $location.path("/");
                        $route.reload();
                    }, console.error);
                };
                $scope.logout = function () {
                    Restangular.all('logout').post().then(function () {
                        authorisation.removeToken();
                        $rootScope.authenticated = authorisation.isAuthenticated();
                        $route.reload();
                    }, console.error);

                }
                $scope.showLogin = function () {
                    var modalInstance = $uibModal.open({
                        templateUrl: 'login.html',
                        animation: true,
                        controller: ['$scope', '$uibModalInstance', function ($scope, $uibModalInstance) {
                            $scope.submitLogin = function () {
                                $uibModalInstance.close($scope.user);
                            };
                            $scope.cancel = function () {
                                $uibModalInstance.dismiss('cancel');
                            };
                        }]
                    });
                    modalInstance.result.then(function (user) {
                        Restangular.all('login').post(user).then(function () {
                            authorisation.setToken('dfasdfasd');
                            $rootScope.authenticated = authorisation.isAuthenticated();
                            $route.reload();
                        }, console.error);
                    }, console.error);
                };

                $scope.showModal = false;
                $scope.toggleModal = function(){
                    $scope.showModal = !$scope.showModal;
                };
            }
        ]);
    var PageController = app.controller('PageController', [
            '$scope',
            '$location',
            'Restangular',
            function($scope, $location, Restangular) {
                $scope.viewArticle = function (article_id) {
                    $location.path( '/article/' + article_id );
                };
                var loadArticles = function()
                {
                    console.log('load articles');
                    Restangular
                        .all('articles')
                        .getList().then(function(articles) {
                        $scope.articles = articles;
                    });
                }
                loadArticles();
            }
        ]);
    var ArticleController = app.controller('ArticleController', [
            '$scope',
            '$route',
            'Restangular',
            'article',
            '$uibModal',
            function($scope, $route, Restangular, article, $uibModal) {
                $scope.article = article;
                var loadAnswers = function()
                {
                    Restangular
                        .one('article/', $route.current.params.articleId)
                        .one('answers')
                        .get()
                        .then(function (answers) {
                            $scope.article.answers = answers;
                        });
                }
                var reload = function()
                {
                    Restangular
                        .one('article/', $route.current.params.articleId)
                        .get()
                        .then(function (article) {
                            $scope.article = article;
                        });
                }
                loadAnswers();
                $scope.postAnswer = function(article_id) {
                    var modalInstance = $uibModal.open({
                        templateUrl: 'createAnswer.html',
                        animation: true,
                        controller: ['$scope', '$uibModalInstance', function ($scope, $uibModalInstance) {
                            $scope.submitAnswer = function () {
                                $uibModalInstance.close($scope.user);
                            };
                            $scope.cancel = function () {
                                $uibModalInstance.dismiss('cancel');
                            };
                        }]
                    });
                    modalInstance.result.then(function (user) {
                        var postData = user;
                        postData.article_id = $scope.article.id
                        Restangular.all('article/' + $route.current.params.articleId + '/answers').post(postData);
                        reload();
                        loadAnswers();
                    }, console.error);
                }

            }
        ]);
        ArticleController.loadArticle = ['Restangular', '$route',
            function(Restangular, $route){
                return Restangular
                    .one('article', $route.current.params.articleId)
                    .get();
            }];
}());