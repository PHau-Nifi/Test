<!DOCTYPE html>
<html lang="en" ng-app="ProductApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bai Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body  ng-controller="ProductController">
    <div class="container mt-5">
        <h2 class="text-center">Quản lý Sản phẩm</h2>
    
        <!-- Form thêm sản phẩm -->
        <form ng-submit="addProduct()">
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" ng-model="newProduct.name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" class="form-control" ng-model="newProduct.price" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
    
        <!-- Danh sách sản phẩm -->
        <h3 class="mt-4">Danh sách sản phẩm</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="product in products">
                    <td>@{{product.id}}</td>
                    <td>@{{ product.name}}</td>
                    <td>@{{ product.price}}₫</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script>
    var app = angular.module("ProductApp", []);
    app.controller("ProductController", function($scope, $http) {
        $scope.products = [];
        $scope.newProduct = {};

        // Lấy danh sách sản phẩm
        $scope.loadProducts = function() {
            $http.get("/api/products")
                .then(function(res) {
                    $scope.products = res.data;
                })
                .catch(function(error) {
                    console.error("error:", error);
                });
        };
        $scope.loadProducts();
        
        //Thêm sản phẩm 
        $scope.addProduct = function() {
            $http.post("/api/products", $scope.newProduct)
                .then(function(response) {
                    $scope.products.push(response.data);
                    $scope.newProduct = {};
                });
        };
    });

</script>
</html>