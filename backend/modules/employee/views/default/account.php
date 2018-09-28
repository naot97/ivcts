<h4 class="m-b-20"><b>ACCOUNT</b></h4>
<div>
    <div class="form-group">
    	<label>Username :</label>
        <input type="text" class="form-control" ng-model="username"> 
    </div>
    <div class="form-group">
    	<label>Password :</label>
        <input type="password" class="form-control" id='password'> 
    </div>
    <div class="form-group">
    	<label>Confirm :</label>
        <input type="password" class="form-control" id='confirm'> 
    </div>
    <div class="form-group">
    	<input type="checkbox" class=" d-inline-block" id='admin'> <p class="d-inline-block"> Is Admin </p>
    </div>
    <button ng-click="saveAccount()" class="btn btn-success"> <i class="fa fa-check"></i>Save</button>
    <button ng-click="removeAccount()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>
</div>

