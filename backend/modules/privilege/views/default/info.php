<div class="form-body" ng-form="formPrivilege">
	<h4 class="card-header text-white">Privilege Info</h4>
	<div class="row ">
		<div class="col-md-3 " >
            <div class="form-group">
            	<label>Index</label>
                <input id='index' type="text" ng-model="indexSelected" class="form-control" disabled="true" />
            </div>
        </div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Group</label>
				<div class="row">
					<div class="input-group">
						<select class="form-control" ng-model ="groupId"  name="group" id="group">
							<option value="">---[Group]---</option>
							<option ng-repeat="gr in listGroup" value="{{gr.groupId}}">{{gr.name}}</option>
						</select>
						<div class="">
							<div class="mega-dropdown">
                                <a class="nav-link text-muted" href="#" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-edit" style="color: green"></i>
                                </a>
                                <div class="dropdown-menu animated zoomIn">
                                     <?php echo $this->render('group'); ?>
                                </div>     
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Privilege Name</label>
                <input type="text" class="form-control" name="name" 
                    maxlength="255"
                    required="true"
                    ng-model="privilegeName"	
                    /> 
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Function Id</label>
                <input type="number" class="form-control" name="id" 
                    maxlength="11"
                    required="true"
                    ng-model ="functionId"
                    /> 
			</div>
		</div>
        
	</div>
	<div class="row ">
		
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Link</label>
                <input type="text" class="form-control" name="link" 
                    maxlength="255"
                    required="true"
                    ng-model="privilegeLink"	
                    /> 
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label"></label>
				<select class="form-control" ng-model="deValue" name="value">
					<option value="">---[Default Status]---</option>
					<option value="k">Keep stable</option>
					<option value="wr">Read write</option>
					<option value="r">Read only</option>
					<option value="n">None</option>
				</select>
			</div>
		</div>
		<div class="col-md-6 p-t-20 p-b-20 ">
            <div class="form-group pull-right" >
                <button ng-click="getListPriBy()" class="btn btn-info"><i class="fa fa-search"></i>Search</button>
                <button ng-click="SavePrivilege()" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                <button ng-click="RemovePrivilege()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>
                <button ng-click="resetInfo()" class="btn btn-primary"> <i class ="fa fa-refresh"> </i>Reset</button>
            </div>
        </div>
	</div>
</div>
