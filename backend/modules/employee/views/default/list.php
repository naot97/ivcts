

<div class="table-responsive p-t-20">
	<h4 class="card-header text-white"> Employee List </h4>
	<table id="tblProject" datatable="ng" dt-options="dtOptions" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Employee Code</th>      
                <th>Section</th>   
                <th>Level</th>
                <th>Rank</th>
                <th>Birth Day</th>
                <th>Telephone</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="employee in employeeList" ng-dblclick="rowSelected($index)"> 
                <td class="index" style=" vertical-align: middle; text-align: center" ng-click="getLogList($index)" onclick="$('#tagHistory').show();$('#tagHistory').dropdown('toggle')">
                    <a href="#">{{$index + 1}}<a/>
                </td>
                <td > 
                	{{employee.employeeName}}
                </td>
                <td>
                	{{employee.employeeCode}}
                </td>
                <td>
                	{{getNameElement(employee.sectionID,'s')}}
                </td>
                <td >
                	{{getNameElement(employee.levelID,'l')}}
                </td>
                <td style="width:2%;">
                	{{getNameElement(employee.rank,'r')}}
                </td>
                <td>
                    {{employee.DoB}}
                </td>
                <td>
                    {{employee.telephone}}
                </td>
                <td>
                    {{employee.mobile}}
                </td>
                <td>
                    {{employee.email}}
                </td>
                <td>
                    {{employee.username}}
                </td>
                
            </tr>
        </tbody>
	</table>

</div>
