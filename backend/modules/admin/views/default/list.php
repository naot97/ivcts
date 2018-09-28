<div class="table-responsive " style="overflow-x: auto;">
	<h4 class="card-header text-white">List Power</h4>	
	<table class="display nowrap table table-hover table-striped table-bordered" datatable="ng" dt-options="dtOptions" cellspacing="0" width="100%">
		<thead>
	            <tr>
	                <th>#</th>
                    <th>Employee Name</th>
                    <th>Employee Code</th>
	                <th>Username</th>
                    <th ng-repeat="pri in privilegeList">{{pri.name}}</th>
	            </tr>
	    </thead>
	    <tbody>
	    	<tr ng-repeat="account in accountList" ng-dblclick ="checkAccount($index)">
                <td class="index" onclick="$('#tagHistory').show();$('#tagHistory').dropdown('toggle')" ng-click ="getLog($index)"><a href="#">{{$index + 1 }} </a></td>
                <td>{{account.employeeName}}</td>
                <td>{{account.employeeCode}}</td>
                <td>{{account.username}}</td>
                <td ng-repeat="privilege in privilegeList">
                <p style="color:{{getFont(powerList[account.employeeID + '-' + privilege.privilegeId])}};">
                    {{powerList[account.employeeID + '-' + privilege.privilegeId] ? powerList[account.employeeID + '-' + privilege.privilegeId]  : 'None'}}
                </p> 
                </td>
            </tr>
	    </tbody>
	   </table>
</div>
