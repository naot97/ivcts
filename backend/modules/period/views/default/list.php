<div class="table-responsive">
    <h4 class="card-header text-white">Period List</h4>
    <table datatable="ng" dt-options="dtOptions" class="display nowrap table table-hover table-striped table-bordered"  width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Time</th>
                <th>Working hours</th>      
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="period in periodList" ng-dblclick="rowSelected($index)"> 
                <td style="width: 1%;vertical-align: middle; text-align: center" >
                    <a href="#">{{$index + 1}}<a/>
                </td>
                <td>
                    {{period.month + '/' + period.year}}
                </td>
                <td>
                    {{period.workingHour}}
                </td>
            </tr>
        </tbody>
    </table>
</div>
