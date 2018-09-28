<style type="text/css">
	:root {
	  --light-border: 1px solid black;
	  --second-color: #ffff8c;
	}
	#tbReport {
		margin-top: 5px !important;
		overflow-x: scroll;
	}
	#tbReport thead {
		text-align: center;
        font-weight: bold;
        background-color: #F0E68C;
	}
	#tbReport thead tr th{
		border: var(--light-border) ; 
	}
	#tbReport tbody tr td{
		border: var(--light-border) ; 
	}
	#tbReport .prName{
		background-color: rgb(221,235,247);
	}
	#tbReport .sale{
		background-color: #FAEBD7;
	}
	#tbReport .ass{
		background-color: #FFFACD;
	}
	#tbReport tbody .section{
		background-color: #C0C0C0 !important;
	}
</style>

<div class="p-t-10 table-responsive" style="">
	<h4 class="card-header text-white">List Report</h4>
	<table id="tbReport" class="table table-bordered"  cellspacing="0" width="100%">
		<thead>
			<tr>
				<th rowspan="2"></th>
				<th rowspan="2">Project Name</th>
				<th colspan="2">Sale Plan</th>
				<th rowspan="2">3 - Spend Time Plan</th>
				<th rowspan="2">4 - Assignment</th>	
				<th rowspan="2">
				Different
				<div >
					<select id='diff' name='diff' ng-model='diffValue' style="width:100px;">
						<option value="0">4 - 3</option>
						<option value="1">4 - 2</option>
						<option value="2">4 - 1</option>
						<option value="3">3 - 2</option>
						<option value="4">3 - 1</option>
						<option value="5">2 - 1</option>
					</select>
				</div>
				</th>	
			</tr>
			<tr>
				<th>1 - SDC</th>
				<th>2 - PM</th>
			</tr>
		</thead>
		<tbody>
			<tr class="section" ng-repeat-start='sID in lstSection'>
				<td>{{GetNameElement(sID,'s')}}</td>
				<td ng-repeat="n in [] | range:6"></td>
			</tr>
			<tr ng-repeat='p in report[sID]'>
					<td></td>
					<td class="prName">{{GetNameElement(p.projectID,'pr')}}</td>
					<td class="sale">{{p.sumSaleSDC}}</td>
					<td class="sale">{{p.sumSalePM}}</td>
					<td>{{p.sumPlan}}</td>
					<td class="ass">{{p.sumActual}}</td>
					<td style="{{getDiff(p) > 0 ?'background-color:#F08080;':getDiff(p) < 0 ? 'background-color: #90EE90' : '';; }}"><b> {{ getDiff(p) }}</b> </td>
			</tr>
			<tr ng-if='sectionID === 0' ng-repeat='p in reportAll'>
				<td></td>
					<td class="prName">{{GetNameElement(p.projectID,'pr')}}</td>
					<td class="sale">{{p.sumSaleSDC}}</td>
					<td class="sale">{{p.sumSalePM}}</td>
					<td >{{p.sumPlan}}</td>
					<td class="ass">{{p.sumActual}}</td>
					<td style="{{getDiff(p) > 0 ?'background-color:#F08080;':getDiff(p) < 0 ? 'background-color:#90EE90' : '';; }}"><b> {{ getDiff(p) }}</b> </td>
			</tr>
			<tr ng-repeat-end hidden="true"></tr>
		</tbody>
	</table>
</div>
