<h4>{{titleOfTable}}</h4>
<div >
	<table  datatable="ng" dt-options="dtOptionsDetail" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th rowspan="2">#</th>
				<th rowspan="2">Employee</th>
				<th colspan="2">Assign</th>
				<th colspan="2">Avail</th>
			</tr>
			<tr>
				<th>Hours</th>
				<th>Ratio</th>
				<th>Hours</th>
				<th>Ratio</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat='employee in detailList'>
				<td class="index">
					<a>{{$index + 1}}</a>
				</td>
				<td>{{employee.employeeCode + '-' + employee.employeeName}}</td>
				<td>{{employee.effort}}</td>
				<td style="color: tomato;" class="ratio">{{(employee.effort / workingHour) | limitTo:5}}</td>
				<td>{{workingHour - employee.effort}}</td>
				<td style="color: green;" class="ratio"> {{((workingHour - employee.effort )/ workingHour) | limitTo:5}}</td>
			</tr>
		</tbody>
	</table>
	 <button onclick="$('#detail').hide()" class="btn btn-warning"> <i class="fa fa-close"></i> Close</button>
</div>
