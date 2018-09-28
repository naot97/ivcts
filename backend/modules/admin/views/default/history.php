<h4 class="m-b-20"><b>History of {{historyTitle}}</b></h4> 
<div style="overflow-x:auto;">
    <table id="tblProject" datatable="ng" dt-options="dtOptions" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th> 
                <th>Privilege</th> 
                <th>Power</th> 
                <th>Update Time</th>        
                <th>Note</th>        
            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat="log in logList">  
                <td class="index">{{$index+1}}</td>   
                <td>{{getNameElement(log.privilegeID,'p')}}
                <td style="color:{{getFont(log.value)}};">{{log.value}} </td>
                <td>{{log.updateTime}}</td>
                <td>{{log.note}}</td>
            </tr>
        </tbody>
    </table>
    <button onclick="$('#tagHistory').hide()" class="btn btn-warning"> <i class="fa fa-close"></i> Close</button>
</div>

