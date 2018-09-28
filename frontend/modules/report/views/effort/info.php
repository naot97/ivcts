<div class="form-body ">
	<h4 class="card-header text-white">Info</h4>
	<div class="row p-t-10">
		<div class="col-md-3">
			<div class="form-group">
				<select class="form-control" id='period'  name="period">
					<option value=''>--[Period]--</option>
					<option ng-repeat="p in periodList" value="{{p.periodID}}">{{p.month + '/' + p.year + '--' + p.workingHour + ' hours'}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group  ">
					<label class="p-r-20 ">Rank :</label> 
					<div class="d-inline-block">
					<span class="p-r-20 d-inline-block" ng-repeat='rank in rankList'><input type="checkbox" id="{{'r' + rank.rankID}}" ng-checked="all">{{ ' ' + rank.rankName + ' '}}</span> 
					<span class="p-r-20"><input type="checkbox" ng-model="all"> ALL</span>
					</div>   
			</div>
		</div>
		<div class="col-md-3 row">
			<div class="col-md-6">
				<div class="form-group ">
				<input class="form-control" type="number" name="from" ng-model='from' placeholder="From">
				</div>
			</div>
			<div class="col-md-6">
				 <div class="form-group ">
				<input class="form-control" type="number" name="to" ng-model='to' placeholder="To">
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group p-t-10">
				<span>
					<input type="checkbox" id="assign" name="assign"> Assign/Avail 
				</span>
				</div>	
		</div>
		<div class="col-md-2">	
			<div class="form-group pull-right">
				<button class="btn btn-primary" ng-click="submit()"><i class="fa fa-arrow-right"></i>Submit</button>
			</div>
		</div>
	</div>
</div>
