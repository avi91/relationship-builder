<html ng-app="app">
<head>
    <title>Relationship Builder</title>
    <link rel="stylesheet" href="<?= asset('semantic/dist/semantic.min.css') ?>">
      <link rel="stylesheet" href="<?= asset('angular/css/app.css') ?>">
    <!--[if lte IE 10]>
    <script type="text/javascript">document.location.href ='/unsupported-browser'</script>
    <![endif]-->
</head>
<body ng-app="app">

    <div class="ui top menu">
      <div class="item">
          <p>Relationship Builder</p>
      </div>
    </div>
    <div ng-view></div>

    <script src="<?= asset('bower_resources/angular/angular.js') ?>"></script>
    <script src="<?= asset('bower_resources/angular-route/angular-route.min.js') ?>"></script>
    <script src="<?= asset('bower_resources/angular-local-storage/dist/angular-local-storage.min.js') ?>"></script>
    <script src="<?= asset('bower_resources/restangular/dist/restangular.min.js') ?>"></script>
    <script src="<?= asset('bower_resources/jquery/dist/jquery.js') ?>"></script>
    <script src="<?= asset('semantic/dist/semantic.min.js') ?>"></script>
    <script src="<?= asset('angular/js/app.js') ?>"></script>
    <script src="<?= asset('angular/js/script.js') ?>"></script>
    <script src="<?= asset('angular/js/controllers.js') ?>" charset="utf-8"></script>
</body>
</html>
