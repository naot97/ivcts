<style type="text/css">
input[type=checkbox] {
  transform: scale(1.5);
}
</style>
<div class="form-body">
	<h4 class="card-header text-white">Grand Privilege</h4>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="label-control"> Account </label>
				<ul class="form-control"  style="overflow-y: scroll;height: 100px;padding: 5px;">
					<li><input type="checkbox" ng-model="all"> All</li>
					<li ng-repeat="account in accountList"><input type="checkbox" id="{{'checkbox'+account.employeeID}}" ng-checked="all" > {{account.username + '-' + account.employeeCode}}</li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label>Privilege</label>
				<select class="form-control " id="privilege" >
  					<option ng-repeat="privilege in privilegeList" value="{{privilege.privilegeId}}">{{privilege.name + '-' + privilege.functionId}}</option>
  					
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label>Power</label>
				<select class="form-control" id="power">
					<option value="wr">Read-Write</option>
					<option value="r">Read</option>
					<option value="n">None</option>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group offset-3 p-t-20 ">
				<label></label>
				<button class="btn btn-primary" ng-click="updatePower()"><i class="fa fa-arrow-right"></i>Submit</button>
			</div>
		</div>
	</div>
</div>
