<div class="form-body" ng-form="formPeriod">
	<h4 class="card-header text-white">Period Info</h4>
	<div class="row ">
		<div class="col-md-3 " >
            <div class="form-group">
            	<label>Index</label>
                <input id='index' type="text" ng-model="indexSelected" class="form-control" disabled="true" />
            </div>
        </div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Month</label>
					<select class="form-control"  name="month" id="month">
						<option value="">---[Month]---</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Year</label>
                <input type="number" class="form-control" name="year" id='year'
                    maxlength="4"
                    required="true"
                    ng-model="year"	
                    /> 
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Working Hours</label>
                <input type="number" class="form-control" name="hours" 
                    maxlength="3"
                    required="true"
                    ng-model ="hours"
                    /> 
			</div>
		</div>
        
	</div>
	<div class="row ">
		<div class="col-md-12 p-t-20 p-b-20 ">
            <div class="form-group pull-right" >
                <button ng-click="getPeriodListBy()" class="btn btn-info"><i class="fa fa-search"></i>Search</button>
                <button ng-click="savePeriod()" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                <button ng-click="resetData()" class="btn btn-primary"> <i class ="fa fa-refresh"> </i>Reset</button>
            </div>
        </div>
	</div>
</div>
