<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//logout
Route::get('/logout', function () {
    \Auth::logout();
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    //index
    Route::get('/', "HomeController@index")->name('index');

    //Change password
    Route::get('/profile', "UserController@profile")->name('profile.index');
    Route::post('/profile', "UserController@profileUpdate")->name('profile.update');

    //Notify Limit
    Route::post('/products/notify/{product}', "ProductController@notify")->name('product.notify');

    //Roles
    Route::resource('roles', RoleController::class)->except('create', 'show', 'destroy');
    //Permissions
    Route::resource('permissions', PermissionController::class)->except('create', 'show', 'destroy');
    //Brands
    Route::resource('brands', BrandController::class)->except('create', 'show', 'destroy');
    //Units
    Route::resource('units', UnitController::class)->except('create', 'show', 'destroy');
    Route::get('/units/getParent/{id}', "UnitController@parents")->name('units.parent');
    //Organizations
    Route::resource('organizations', OrganizationController::class)->except('create', 'show', 'destroy');
    //Stores
    Route::resource('stores', StoreController::class)->except('create', 'show', 'destroy');
    //Categories
    Route::resource('categories', CategoryController::class)->except('create', 'show', 'destroy');
    //Products
    Route::resource('products', ProductController::class)->except('show');
    Route::get('products/trashed', "ProductController@trashGet")->name('products.trashed.get');
    Route::delete('/products/trashed/{product}', "ProductController@trashPost")->name('products.trashed.post');
    Route::post('/products/restore/{product}', "ProductController@restore")->name('products.restore');
    Route::get('/products/getCategory/{id}', "ProductController@getCategory")->name('products.category.get');
    Route::get('/products/getStore/{id}', "ProductController@getStore")->name('products.store.get');

    //Histories
    Route::get('/histories', "HistoryController@index"::class)->name('history.index');

    //Employees
    Route::resource('employees', EmployeeController::class)->except('create', 'show', 'destroy');
    Route::get('/employees/getUnit/{id}', "EmployeeController@getUnit")->name('employees.unit');
    Route::get('/employees/getChildUnit/{id}', "EmployeeController@getChildUnit")->name('employees.childUnit');
    //users
    Route::patch('users/{user}/update', "UserController@update")->name('users.update');
    Route::resource('users', UserController::class)->except('create', 'show');

    //Deliveries
    Route::resource('deliveries', DeliveryController::class)->except('show');
    Route::get('/deliveries/getEmployee/{id}', "DeliveryController@getEmployee")->name('deliveries.employees');

    //Invoices
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/details', "InvoiceController@detailList")->name('details.list');

    //Details For Invoice
    Route::delete('/invoices/detail/{detail}', "InvoiceController@deleteDetail")->name('invoices.detail.delete');
    Route::get('/details', "InvoiceController@detailList")->name('invoices.detail.list');
    Route::get('/invoices/detail/{detail}/edit', "InvoiceController@editDetail")->name('invoices.detail.edit');
    Route::patch('/invoices/detail/{detail}/edit', "InvoiceController@updateDetail")->name('invoices.detail.update');
    Route::get('/invoices/detail/{invoice}/create', "InvoiceController@addDetailGet")->name('detail.add.get');
    Route::post('/invoices/detail/{invoice}/create', "InvoiceController@addDetailPost")->name('detail.add.post');

    //Stocks
    Route::resource('stocks', StockController::class)->except('show');
    Route::get('/stocks/getEmployee/{id}', "StockController@getEmployee")->name('stocks.employees');
    Route::get('/stocks/getCategory/{id}', "StockController@getCategory")->name('stocks.category.get');
    Route::get('/stocks/getStore/{id}', "StockController@getStore")->name('stocks.store.get');

    //Abortions - کالاهای اسقاطی
    Route::resource('abortions', AbortionController::class)->except('show');

    //logs
    Route::get('/logs', "LogController@index")->name('logs.index');

    //Reports
    Route::get('/reports/deliveris', "ReportController@deliveries")->name('reports.deliveries.index');

    //Transfers
    Route::resource('transfers', TransferController::class)->except('show');
    Route::post('transfers/approved/{transfer}', "TransferController@approved")->name('transfers.approved');
    Route::post('transfers/read/{transfer}', "TransferController@read")->name('transfers.read');
    Route::get('transfers/add-product/{transfer}', "TransferController@addProduct")->name('transfers.add.product');
    Route::patch('transfers/add-product/{transfer}', "TransferController@storeProduct")->name('transfers.store.product');
    Route::get('transfers/product/deny/{transfer}', "TransferController@denyTransfer")->name('transfers.deny');

    //Stocks
    Route::resource('repairs', RepairController::class)->except('show');
    Route::get('/repairs/getEmployee/{id}', "RepairController@getEmployee")->name('repairs.employees');
    Route::get('/repairs/getCategory/{id}', "RepairController@getCategory")->name('repairs.category.get');
    Route::get('/repairs/getStore/{id}', "RepairController@getStore")->name('repairs.store.get');

    //CHANGE INFO
    Route::get('/change-info', "HomeController@changeInfoGet")->name('profile.change.get');
    Route::post('/change-info', "HomeController@changeInfoPost")->name('profile.change.post');

    //CHANGE SETTINGS
    Route::get('/settings', "SettingController@index")->name('settings.index');
    Route::post('/settings', "SettingController@update")->name('settings.update');

    //WAREHOUSE REPORTSS
    Route::get('/reports/warehouse', "ReportController@warehouse")->name('warehouse.index');
    Route::get('/reports/warehouse/filter', "ReportController@warehouseFilter")->name('warehouse.filter');

});
