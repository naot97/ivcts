<h4 class="m-b-20"><b>History of {{historyTitle}}</b></h4>
<div style="overflow-x:scroll;">
    <table  datatable="ng" dt-options="dtOptions" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th> 
                <th>Employee Code</th>      
                <th>Employee Name</th>
                <th>Status</th>
                <th>Username</th>
                <th>Section</th>
                <th>Level</th>
                <th>Rank</th>
                <th>Start Date</th>     
                <th>End Date</th> 
                <th>Birth Date </th>
                <th>Marital Status </th>
                <th>Telephone</th>
                <th>Mobile </th>
                <th>Email </th>
                <th>Registerd Address </th>
                <th>Current Address </th>       
                <th>Update Time</th>        
                <th>Action</th>        
                <th>Note</th>        
            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat="log in logList">  
                <td class="index">{{$index+1}}</td>   
                <td style="color:{{changeColor($index,'employeeCode')}};">{{log.employeeCode}}</td>
                <td style="color:{{changeColor($index,'employeeName')}};">{{log.employeeName}}</td>
                <td style="color:{{changeColor($index,'status')}};">{{log.status == 1 ? 'Active' : 'Closed'}}</td>
                <td style="color:{{changeColor($index,'username')}};">{{log.username}}</td>
                <td style="color:{{changeColor($index,'sectionID')}};">{{getNameElement(log.sectionID,'s')}}</td>
                <td style="color:{{changeColor($index,'levelID')}};">{{getNameElement(log.levelID,'l')}}</td>
                <td style="color:{{changeColor($index,'rank')}};">{{getNameElement(log.rank,'r')}}</td>
                <td style="color:{{changeColor($index,'startDate')}};">{{log.startDate}}</td>
                <td style="color:{{changeColor($index,'endDate')}};">{{log.endDate}}</td>
                <td style="color:{{changeColor($index,'Dob')}};">{{log.Dob}}</td>
                <td style="color:{{changeColor($index,'maritalStatus')}};">{{log.maritalStatus == 1 ? 'Yes' : 'No'}}</td>
                <td style="color:{{changeColor($index,'telephone')}};">{{log.telephone}}</td>
                <td style="color:{{changeColor($index,'mobile')}};">{{log.mobile}}</td>
                <td style="color:{{changeColor($index,'email')}};">{{log.email}}</td>
                <td style="color:{{changeColor($index,'registeredAddress')}};">{{log.registeredAddress}}</td>
                <td style="color:{{changeColor($index,'currentAddress')}};">{{log.currentAddress}}</td>
                <td>{{log.updateTime}}</td>
                <td>{{log.action}}</td>
                <td>{{log.note}}</td>
            </tr>
        </tbody>
    </table>
    <button onclick="$('#tagHistory').hide()" class="btn btn-warning"> <i class="fa fa-close"></i> Close</button>
</div>
