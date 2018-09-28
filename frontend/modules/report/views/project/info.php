<div class="form-body">
	<h4 class="card-header text-white">Info Report</h4>
	<div class="row p-t-10">
		<div class="col-md-3">
			<div class="form-group">
				<select class="form-control" id='period' name='period'>
					<option value="">--[Period]--</option>
					<option ng-repeat='p in lstPeriod' value="{{p.periodID}}">{{p.year + '/' + p.month + ': ' + p.workingHour + 'h'}}</option>
				</select>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<select class="form-control" id='section' name='section'>
					<option value="">--[Section]--</option>
					<option value="0"><b>ALL SECTION</b></option>
					<option ng-repeat='s in lstSectionInfo' value="{{s.sectionID}}">{{s.sectionName}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<select id="pro" class="form-control"  >
					<option value="">--[Project]--</option>
					<option ng-repeat='p in lstProjectInfo' value="{{p.projectID}}">{{p.projectName}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<select class="form-control" id='rank' name='rank'>
					<option value="">--[Rank]--</option>
					<option value="0"><b>O/A</b></option>
					<option value="-1"><b>B/C/R</b></option>
					<option ng-repeat='r in lstRank' value="{{r.rankID}}">{{r.rankName}}</option>
				</select>
			</div>
		</div>
		<div class="col-md-3">
            <div class="form-group pull-right" style="align-content: center">
                <button class="btn btn-info" ng-click='getProjectReportBy()'><i class="fa fa-search"></i>Search</button>
                <button onclick="$('#tbReport').hide()" ng-click='reset()' class="btn btn-primary"><i class="fa fa-refresh"></i>Reset</button>
            </div>
        </div>
	</div>
	
</div>
